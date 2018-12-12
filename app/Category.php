<?php

namespace App;

use App\Website;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
			'name', 'description'
		];

		public function websites()
    {
        return $this->hasMany('App\Website');
    }
}
