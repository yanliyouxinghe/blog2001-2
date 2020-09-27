<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
  protected $table = 'goods_type';
  protected $guarded = [];
  protected $primaryKey = "cat_id";

  // protected $fillable = ['cat_name','enabled','attr_group'];
  public $timestamps = false;
}
