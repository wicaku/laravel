<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class ckanOpendataModel extends Model
{
    //
    use HybridRelations;
    protected $connection = 'mysql';
    protected $table = 'ckan_scored_dataset';
}
