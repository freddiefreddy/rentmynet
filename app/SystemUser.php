<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SystemUser extends Authenticatable
{
    protected $fillable = ['name', 'email', 'phone', 'blocked', 'type',  'password', 'phone_verified_at'];


    protected $hidden = [
        'password',  
    ];


    public function hasVerifiedPhone()
    {
        return (bool)$this->verified;
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'verified' => true,
        ])->save();
    }

}