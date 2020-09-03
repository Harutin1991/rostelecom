<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectedServices extends Model
{
    protected $fillable = ['service_id', 'connected_service_id'];
}
