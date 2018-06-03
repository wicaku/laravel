<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class facebookAccountsModel extends Eloquent
{
    protected $collection = 'facebook_accounts';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
