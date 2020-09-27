<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  protected $table = 'user_role';
  // protected $guarded = [];
  protected $primaryKey = "user_role_id";

  protected $fillable = ['admin_user_id','role_id'];
  public $timestamps = false;
}
