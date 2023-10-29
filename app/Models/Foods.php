<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = [
        'food_name',
        'category',
        'price',
        'image',
        'description',
        'create_by'
    ];
}
