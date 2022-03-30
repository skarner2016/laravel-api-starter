<?php

namespace App\Models;

use App\Lib\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory;

    protected $connection = App::DB_CONNECTION_MYSQL;

    protected $guarded = [];
}
