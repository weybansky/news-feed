<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
    	'category_id', 'name', 'main_url', 'feed_name', 'feed_url', 'type_of_feed', 'icon'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
