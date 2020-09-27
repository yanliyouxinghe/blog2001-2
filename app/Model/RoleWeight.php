<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleWeight extends Model
{
  protected $table = 'role_weight';
  // protected $guarded = [];
  protected $primaryKey = "role_weight_id";

  protected $fillable = ['role_id','weight_id'];
  public $timestamps = false;

}
