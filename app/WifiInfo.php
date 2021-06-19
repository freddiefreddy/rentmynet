<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WifiInfo extends Model
{
    protected $fillable = ['Wi_id','vuid', 'SSID', 'BSID', 'password', 'link_speed', 'up_speed', 'down_speed'];


    public function system_def(){
    	return $this->belongsTo(SystemUser::class, 'vuid');
    }

}