<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class youtubeAccountsResultModel extends Eloquent
{
    protected $collection = 'youtube_accounts_result';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
