<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class youtubeAccountsModel extends Eloquent
{
    protected $collection = 'youtube_accounts';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
