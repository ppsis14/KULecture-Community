<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Conner\Tagging\Taggable;

class Post extends Model
{
    use SoftDeletes;
    use Taggable;
    
    protected $fillable = ['post_title', 'post_detail', 'post_tag', 'hidden_status', 'post_cover', 'description', 'category', 'report_status', 'file'];

    // 01/05/62
    public function user()
    {
        return $this->belongsTo('App\User')->nullable();
    }
}
