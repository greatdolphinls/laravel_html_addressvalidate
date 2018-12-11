<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;

class ContactController extends Controller
{

    public function contact(Request $request) {

        $data = array(
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'message'   => $request->input('message')
        );

        Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
            $message->from($data['email'], $data['name'])
                    ->to(env('SUPPORT_EMAIL'))
                    ->subject('Contact Us');
        });

        return redirect('contact');
        
    }
}
