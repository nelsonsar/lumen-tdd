<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Girl extends Model
{
    protected $table = 'girls';
    protected $fillable = ['name', 'cover_photo', 'photo_source'];
}