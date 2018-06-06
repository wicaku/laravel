<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class resultOpendataModel extends Model
{
    //
    use HybridRelations;
    protected $connection = 'mysql';
    protected $table = 'result_opendata';
}
