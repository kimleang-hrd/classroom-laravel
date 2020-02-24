<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        "class_name", "class_subject", "class_description", 
        "class_image", "referral_code", "owner_id"
    ];
    
}
