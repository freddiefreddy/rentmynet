<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedeemCard extends Model
{
    protected $fillable = ['rcid','code', 'pid', 'used'];

    public function package_desc()
    {
        return $this->belongsTo(PackageDetail::class, 'pid');
    }
}
