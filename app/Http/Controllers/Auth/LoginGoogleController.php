<?php

namespace App\Http\Controllers\Auth;
// namespace App\Repositories;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

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
            auth()->login($existingUser,true);
        }else{
            //create a new user
            $newUser                    = new User;
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->username          = $user->getName();
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();
            auth()->login($newUser,true);
        }
        return redirect()->to('user/home');
    }
}
