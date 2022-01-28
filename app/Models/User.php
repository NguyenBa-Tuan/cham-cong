<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'dayOfBirth',
        'dayOfJoin',
        'role',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function timesheet()
    {
        return $this->hasMany('App\Models\Timesheet');
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class);
    }

    public function overtime()
    {
        return $this->hasMany('App\Models\Overtime');
    }

    public function getInfoLevelAttribute()
    {
        return Level::find($this->level);
    }
}
