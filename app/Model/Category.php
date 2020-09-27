<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
		protected $table = 'ecs_category';
		    protected $guarded = []; 
		    protected $primaryKey = "cat_id";
			  
			    // protected $fillable = ['cat_name','enabled','attr_group'];
			public $timestamps = false;
			//
}
