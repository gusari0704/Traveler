<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;


class Form extends Model
{
    use Favoriteable;
    
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
