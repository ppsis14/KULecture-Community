<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['contact', 'type'];


    public function user(){
        return $this->belongsTo('\App\User');
    }
}
