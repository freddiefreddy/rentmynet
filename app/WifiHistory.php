<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WifiHistory extends Model
{
    protected $fillable = ['wi_id','uid', 'time_used', 'mb_used', 'rent'];


    public function wifi_details(){
    	return $this->belongsTo(WifiInfo::class, 'wi_id');
    }

    public function system_def(){
    	return $this->belongsTo(SystemUser::class, 'uid');
    }

}