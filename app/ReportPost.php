<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportPost extends Model
{
    use SoftDeletes;
    protected $fillable = ['report_admin', 'report_user'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
