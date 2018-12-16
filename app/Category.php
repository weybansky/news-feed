<?php

namespace App;

use App\Website;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
			'name', 'description'
		];

		protected $hidden = [
			'created_at', 'updated_at', 'slug'
		];

		public function websites()
    {
        return $this->hasMany('App\Website');
    }
}
