<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['eid','uid', 'earn', 'Withdraw'];

    public function system_def()
    {
        return $this->belongsTo(System_user::class, 'uid');
    }

}