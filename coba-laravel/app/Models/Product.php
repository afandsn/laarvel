<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ✅ tambahkan ini:
    protected $fillable = ['name', 'price', 'description'];
}
