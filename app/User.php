<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('\App\Article');
    }

    public function lastUpdated() {
        return $this->hasMany('\App\Article', 'last_modified_by');
    }

    // Mutator (formats input and runs before saving to DB)
    public function setUsernameAttribute($value) {
        $this->attributes['username'] = strtolower($value);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    // Accessor (formats and runs before the data is rendered)
    public function getNameAttribute($value) {
        return ucwords($value);
    }
}
