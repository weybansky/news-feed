<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

	protected $fillable = [
		'website_id', 'category_id', 'post_title', 'post_url', 'pub_date', 'post_content', 'post_id', 'post_picture'
	];

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function website()
	{
		return $this->belongsTo('App\Website');
	}

}
