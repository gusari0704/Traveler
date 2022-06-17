<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/*アカウント作成時にメールが送信される*/
  class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,
    
        public function bookmark_Favorites()
    {
        return $this->belongsToMany(Favorite::class, 'bookmarks', 'user_id', 'form_id');
    }
}
