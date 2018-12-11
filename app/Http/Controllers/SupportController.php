<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Profile;
use Mail;
use File;

class SupportController extends Controller
{
    //
    public function support() {
        $data = $this->getProfile();
        $data['username'] = $data['firstname'];
        return view('user.support', ['data' => $data]);
    }

    public function send(Request $request) {
        $filePaths = array();
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $i = 0;
            foreach ($files as $file) {
                $i++;
                if ($i > 5) break;
                array_push($filePaths, $file->move($this->getContentsPath() . '/upload', $file->getClientOriginalName()));
            }
        }

        $data = array(
            'topic'     => $request->input('topic'),
            'subject'   => $request->input('subject'),
            'firstname' => $request->input('firstname'),
            'lastname'  => $request->input('lastname'),
            'phone'     => $request->input('phone'),
            'message'   => $request->input('message'),
            'email'     => User::find($this->getUserid())->email,
            'files'     => $filePaths
        );

        Mail::send('emails.support', ['data' => $data], function ($message) use ($data) {
            $message->from($data['email'], $data['firstname'] . ' ' . $data['lastname'])
                    ->to(env('SUPPORT_EMAIL'))
                    ->subject($data['subject']);
            foreach ($data['files'] as $file) {
                $message->attach($file);
            }
        });
        foreach ($filePaths as $file) {
            File::delete($file->getPath() . '/' . $file->getFileName());
        }

        return redirect('support');
    }
}
