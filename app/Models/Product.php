<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku', 'category', 'image', 'name', 'price', 'qty', 'description'
    ];

    /**
     * The name of the table is assigned.
     *
     * @var string
     */
    protected $table = 'products';

}
