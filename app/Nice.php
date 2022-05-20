<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nice extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
 
    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
}
