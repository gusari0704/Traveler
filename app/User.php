<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
/* アカウント作成時、パスワード再発行時に日本語される */
use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPassword;
use Overtrue\LaravelFavorite\Traits\Favoriter;

/*アカウント作成時にメールが送信される*/
  class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Favoriter;
    
    /* アカウント作成時の日本語化 */
     public function sendEmailVerificationNotification()
     {
         $this->notify(new CustomVerifyEmail());
     }
    /* パスワード再発行時に日本語される */
     public function sendPasswordResetNotification($token) {
         $this->notify(new CustomResetPassword($token));
     }

     function IdentityProviders()
    {
        // IdentityProviderモデルと紐付ける 1対多の関係
        return $this->hasMany(IdentityProvider::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    /* アカウント作成時に入力された内容を自動的に保存する */
    protected $fillable = [
        'name', 'email', 'password', 'postal_code', 'address', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('app\Post');
    }

    public function nices() {
        return $this->hasMany('app\Nice');
    }
}
