<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class facebookPostsModel extends Eloquent
{
    protected $collection = 'facebook_posts';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
