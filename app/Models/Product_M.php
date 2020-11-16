<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// I had to rename it since class Product keeps generating an unresolvable error kind of a reserved word!
class Product_M extends Model
{
    use HasFactory;
    //Since the change the model name to a custom one we need to write this down or else it will look for product_m_s which does not exists
    protected $table = 'products';

    protected $guarded = [
        'id'
    ];
}
