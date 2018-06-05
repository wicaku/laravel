<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class twitterAccountsResultModel extends Eloquent
{
    protected $collection = 'twitter_accounts_result';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
