<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
/* アカウント作成時、パスワード再発行時に日本語される */
use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPassword;

/*アカウント作成時にメールが送信される*/
  class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /* アカウント作成時の日本語化 */
     public function sendEmailVerificationNotification()
     {
         $this->notify(new CustomVerifyEmail());
     }
    /* パスワード再発行時に日本語される */
     public function sendPasswordResetNotification($token) {
         $this->notify(new CustomResetPassword($token));
     }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
}
