<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

        protected $fillable = [         
            "denomination",
            "serial_number",
            "archived",
            "repair_state",
            "type"
        ];

}
