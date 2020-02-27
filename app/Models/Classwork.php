<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classwork extends Model
{
    protected $table = "classworks";

    protected $fillable = [
        "title", "description", "link", "file", "class_id", "user_id"
    ];

}
