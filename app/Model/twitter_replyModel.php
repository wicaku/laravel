<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class twitter_replyModel extends Eloquent
{
    protected $collection = 'twitter_reply';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
