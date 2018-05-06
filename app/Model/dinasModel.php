<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class dinasModel extends Eloquent
{
    protected $collection = '';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
