<?php

namespace App;

use App\Notifications\Institute\Auth\ResetPassword;
use App\Notifications\Institute\Auth\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Institute extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'password_reset_token', 
        'password_reset_token_expiry', 
        'is_verified', 
        'verification_token',
        'status',
        'admin_id',
        'phone',
        'image',
        'no_of_teacher'
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    //full image url
    public function getFullImageUrlAttribute(){
        if($this->image == null || $this->image == 'default.png'){
            return default_image_url();
        } else {
            return url('storage/institute_profile') . '/' . $this->image;
        }
    }

    public function getAdminStatusAttribute(){
        $admin = Admin::find($this->admin_id);

        return $admin->status;
    }

}
