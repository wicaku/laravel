<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class bpsOpendataModel extends Model
{
    //
    use HybridRelations;
    protected $connection = 'mysql';
    protected $table = 'bps_scored_dataset';
}
