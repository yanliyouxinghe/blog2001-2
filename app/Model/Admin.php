<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  protected $table = 'admin_user';
 // protected $guarded = [];
 protected $primaryKey = "admin_user_id";

 protected $fillable = ['admin_user','admin_pwd','admin_plone'];
 public $timestamps = false;
}
