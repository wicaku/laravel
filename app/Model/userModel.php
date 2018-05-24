<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class userModel extends Eloquent
{
    protected $collection = 'users';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function dinas() {
      return $this->hasMany('App\Model\dinasModel', 'idUser');
    }

    public function pemda() {
      return $this->hasOne('App\Model\listPemdaModel', '_id', 'idPemda');
    }
}
