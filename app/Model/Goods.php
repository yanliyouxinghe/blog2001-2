<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'ecs_goods';
    protected $guarded = [];
    protected $primaryKey = "goods_id";
  
    // protected $fillable = ['cat_name','enabled','attr_group'];
    public $timestamps = false;
}
