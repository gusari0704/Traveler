<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
 
    public function nices() {
        return $this->hasMany('App\Models\Nice');
    }
}
