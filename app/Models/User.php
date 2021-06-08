<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable,LogsActivity,HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates=['dob','joining'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments(){
        return $this->belongsTo('App\Models\Department','department')->withDefault();
    }
    public function designations(){
        return $this->belongsTo('App\Models\Designation','designation')->withDefault();
    }

    public function roles(){
        return $this->belongsTo('App\Models\Role','user_type')->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static $logAttributes = ['id', 'fname', 'lname','profile','user.cnic','address'];
    protected static $logOnlyDirty = true;
}
