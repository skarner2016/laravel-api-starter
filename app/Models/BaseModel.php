<?php

namespace App\Models;

use App\Lib\App;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = App::DB_CONNECTION_MYSQL;

    protected $guarded = [];
}
