<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    //
    protected $table = 'paypal';

    public function profile() {
        return $this->belongsTo('App\Models\Profile');
    }
}
