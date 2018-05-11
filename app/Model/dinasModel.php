<?php

namespace App\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

class dinasModel extends Eloquent
{
  protected $collection = 'dinas';

  protected $fillable = [
      'nama_dinas', 'deskripsi_dinas', 'keyword',
  ];

  use SoftDeletes;
  protected $dates = ['deleted_at'];

  public function user() {
    return $this->belongsTo('App\Model\userModel');
  }

}
