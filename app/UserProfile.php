<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use SoftDeletes;
    protected $fillable = ['avatar', 'bio', 'facebook', 'twitter' , 'instagram', 'line'];

    public function user(){
        return $this->belongsTo('\App\User');
    }
}
