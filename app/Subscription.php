<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['sid','uid', 'pid', 'status'];

    public function system_def()
    {
        return $this->belongsTo(SystemUser::class, 'uid');
    }

    public function package_desc()
    {
        return $this->belongsTo(PackageDetail::class, 'pid');
    }
}