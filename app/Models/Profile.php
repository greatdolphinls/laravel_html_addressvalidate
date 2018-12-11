<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = 'profiles';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function visa() {
        return $this->hasOne('App\Models\Visa');
    }

    public function paypal() {
        return $this->hasOne('App\Models\Paypal');
    }
}
