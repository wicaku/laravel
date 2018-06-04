<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class youtubeCommentsModel extends Eloquent
{
    protected $collection = 'youtube_comment';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
