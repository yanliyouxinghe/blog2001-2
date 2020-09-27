<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    // protected $guarded = [];
    protected $primaryKey = "role_id";

    protected $fillable = ['role_name','role_desc'];
    public $timestamps = false;

}
