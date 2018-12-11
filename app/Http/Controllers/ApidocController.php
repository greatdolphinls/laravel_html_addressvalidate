<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Profile;

class ApidocController extends Controller
{
    //
    public function apidoc() {
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        return view('user.documentation', ['data' => $data]);
    }
}
