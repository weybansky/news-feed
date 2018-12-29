<?php

namespace App;

use App\Website;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
			'name', 'description', 'slug'
		];

		protected $hidden = [
			'created_at', 'updated_at',
		];

		public function websites()
    {
      return $this->hasMany('App\Website');
    }

    public function feeds()
    {
      return $this->hasMany('App\Feed');
    }
}
