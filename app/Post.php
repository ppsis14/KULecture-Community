<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['post_title', 'post_detail', 'post_tag', 'hidden_status'];
}
=======
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['post_title', 'post_detail', 'post_tag', 'hidden_status'];
}
>>>>>>> 08742661ee61e2e95f5f69d499da22a0526c1500
