<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'slug',
      'stripe_id',
      'price',
      'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
