<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    protected $fillable = ['path','company_name', 'display_iteration', 'display', 'cost'];

}