<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class pemdaModel extends Model
{
    //
    use HybridRelations;
    protected $connection = 'mysql';
    protected $table = 'pemda';

}
