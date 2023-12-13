<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'slug',
        'price',
        'ref',
        'characteristics',
        'images',
        'labels'
    ];
}