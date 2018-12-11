<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    //
    protected $table = 'visa';

    public function profile() {
        return $this->belongsTo('App\Models\Profile');
    }
}
