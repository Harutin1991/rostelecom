<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ConnectedServices;

class Service extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get the phone record associated with the user.
     */
    public function connectedServices()
    {
        return $this->hasMany('App\ConnectedServices');
    }
}
