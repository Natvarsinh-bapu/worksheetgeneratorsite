<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'enrollment_no', 
        'password_reset_token', 
        'password_reset_token_expiry', 
        'is_verified', 
        'verification_token',
        'status',
        'role',
        'phone',
        'institute_id',
        'class',
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

    public function className(){
        return $this->belongsTo(ClassName::class, 'class');
    }

    public function scopeStudent($query){
        return $query->where('role', 'student');
    }

    public function scopeTeacher($query){
        return $query->where('role', 'teacher');
    }

    public function institute(){
        return $this->belongsTo(Institute::class, 'institute_id');
    }

    public function teacherClasses(){
        return $this->hasMany(ClassTeacher::class, 'teacher_id');
    }

    public function getEnrollmentNumberAttribute(){
        $value = '';
        if($this->enrollment_no != null){
            $data = explode('_', $this->enrollment_no);

            $value = isset($data[1]) ? $data[1] : $data[0];
        }

        return $value;
    }
}
