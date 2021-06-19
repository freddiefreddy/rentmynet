<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorTransaction extends Model
{
    protected $fillable = ['uid','account_no', 'amount', 'status'];


    public function system_def(){
    	return $this->belongsTo(SystemUser::class, 'uid');
    }

}