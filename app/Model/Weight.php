<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
  protected $table = 'weight';
  // protected $guarded = [];
  protected $primaryKey = "weight_id";

  protected $fillable = ['weight_name','url','routename'];
  public $timestamps = false;
}
