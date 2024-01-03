<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'city',
        'address',
        'informations',
        'photo1',
        'photo2',
        'photo3',
        'price',
        'note'
    ];
}
