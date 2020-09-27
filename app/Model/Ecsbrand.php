<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ecsbrand extends Model
{
     protected $table = 'ecs_brand';
    protected $guarded = [];
    protected $primaryKey = "brand_id";

    // protected $fillable = ['brand_name','brand_url','brand_logo','brand_desc'];
    public $timestamps = false;

}
