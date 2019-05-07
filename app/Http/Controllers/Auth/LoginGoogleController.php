<?php

namespace App\Http\Controllers\Auth;
// namespace App\Repositories;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\UserProfile;
use Hash;
use DB;
use DateTime;

class LoginGoogleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try{
           $user = Socialite::driver('google')->stateless()->user();
        } catch(Exception $e){
            return redirect('user/login');
        }
        //allow only ku account to use the system
        if(explode("@",$user->email)[1] !== 'ku.th'){
            return redirect()->to('/');
        }
        //check if they're an existing user
        $existingUser = User::where('email',$user->email)->first();
        if($existingUser){
            // log them in
            $existingUser->update(['login_time' => now()]);
            $existingUser->profile()->update(['avatar' =>  $user->getAvatar()]);
            auth()->login($existingUser,true);
            $profile =  User::where('provider_id', $user->getId())->first();
            return redirect()->action('HomeUserController@show' , ['id' => $profile->id]);
        }else{
            //create a new user
            $newUser                    = new User;
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->username          = $user->getName();
            $newUser->password          = Hash::make($user->getId());
            $newUser->login_time        = now();
            $newUser->save();

            $newUser->profile()->create(['avatar' =>  $user->getAvatar()]);

            auth()->login($newUser,true);
             
            $profile =  User::where('provider_id', $user->getId())->first();
            return redirect()->action('HomeUserController@show' , ['id' => $profile->id])->with('newUser','Welcome to KU Knowledge Share Community - please enjoy with sharing your knowledge with others');
        }

       

        
    }
}
