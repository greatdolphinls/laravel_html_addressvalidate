<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model
{
    protected $table = 'users';

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

    public function invoices() {
        return $this->hasMany('App\Models\Invoice');
    }
}
