<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class listPemdaModel extends Eloquent
{
    protected $collection = 'listpemda';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
