<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [

        'about_us_image',
        'first_description',
        'first_point',
        'second_point',
        'third_point',
        'slug',
        'status',
        'last_description',
        'deleted_at',
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}