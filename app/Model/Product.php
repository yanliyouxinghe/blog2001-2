<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ecs_products';
    protected $guarded = [];
    protected $primaryKey = "product_id";
  
    // protected $fillable = ['cat_name','enabled','attr_group'];
    public $timestamps = false;
}
