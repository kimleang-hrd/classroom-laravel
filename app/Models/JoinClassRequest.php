<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinClassRequest extends Model
{
    protected $table = "join_class_request";

    protected $fillable = [
        "user_id", "class_id", "description", "owner_id"
    ];

}
