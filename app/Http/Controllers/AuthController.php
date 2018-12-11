<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User ;
use App\Models\Profile ;
use App\Models\Invoice ;
use App\Models\Transaction ;
use Auth;
use Mail;
use PDF;
use Illuminate\Support\Facades\Session;
use URL;

class AuthController extends Controller
{

    public function signup(Request $request){
        $user = new User;
        $user->password =  bcrypt($request->input('password'));
        $user->email =  $request->input('email');
        $user->role =  "user";
        $user->block = true;
        $user->save();

        $profile = new Profile;
        $profile->company_name =  $request->input('company_name');
        $profile->plan =  $request->input('choose_plan');
        if ($profile->plan == '')
        {
            $profile->plan = 'Free';
        }
        switch ($profile->plan ) {

            case 'Business-Monthly' :

                $invoice = new Invoice;
                $invoice->user_id = $user->id;
                $current_time = date('Y-m-d H:i:s');
                $invoice->start_time = $current_time;
                $invoice->end_time =date('Y-m-d H:i:s', strtotime('+30 days'));
                $invoice->amount = 99;
                $invoice->status = 'DUE';
                $invoice->pay_url = '2016PDF';
                $invoice->save();
                break;


            case 'Business-Yearly':
                $invoice = new Invoice;
                $invoice->user_id = $user->id;
                $current_time = date('Y-m-d H:i:s');
                $invoice->start_time = $current_time;
                $invoice->end_time = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y")+1));
                $invoice->amount = 1000;
                $invoice->status = 'DUE';
                $invoice->pay_url = '2016PDF';
                $invoice->save();
                break;

            case 'Enterprise' :
                $invoice = new Invoice;
                $invoice->user_id = $user->id;
                $current_time = date('Y-m-d H:i:s');
                $invoice->start_time = $current_time;
                $invoice->end_time = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y")+1));
                $invoice->amount = 2000;
                $invoice->status = 'DUE';
                $invoice->pay_url = '2016PDF';
                $invoice->save();
                break;

        }
        $profile->website_domain =  $request->input('website_domain');
        $contact =  $request->input('contact');
        $contacts = preg_split('/ /', $contact);
        $profile->firstname = $contacts[0];
        $profile->lastname = isset($contacts[1])?$contacts[1]:'';
        $profile->phone_number =  $request->input('phone_number');
        $profile->user_id =  $user->id;
        $profile->pay_method = 'visa';
        $profile->save();

        $data = array(
            'name'   => $profile->firstname .' '. $profile->lastname,
            'email'  => $user->email,
            'plan'   => $profile->plan
        );

//        Mail::send('emails.signup', ['data' => $data], function ($message) use ($data) {
//            $message->from(env('SUPPORT_EMAIL'))
//                    ->to($data['email'])
//                    ->subject('Welcome to Valid Address.');
//        });
        return redirect('signin');
    }

    public function signin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $secret = array('email' => $email , 'password' => $password);
        if(Auth::attempt($secret,1)){
            $user_id = Auth::user()->id;
            Session::put('userid', $user_id);
            Session::put('role', Auth::user()->role);
            if(Auth::user()->role == 'admin'){
                return redirect('admin');
            }
            if(Auth::user()->role == 'user'){
                if(!Auth::user()->block){
                    Session::flash('error', 'Your user account has been suspended. For more details please contact support at support@validaddress.com');
                    return redirect('signin');
                }
                return redirect('dashboard');
            }
        }else{
            Session::flash('error','Wrong Email or Password. Please Correct');
            return redirect('signin');
        }
    }

    //forget
    public function forget(Request $request){
        
        $email = $request->input('email');
        $users = User::get();
        foreach ($users as $user)
        {
            if ($email == $user->email){
                $profile = Profile::where('user_id',$user->id)->first();
                $trim = md5($user->password);
                $reset_link = URL::to('/') . '/reset_password/'.$trim;

                $data = array(
                    'name'          => $profile->company_name,  // user name
                    'email'         => $email,
                    'reset_link'    => $reset_link    // password reset url
                );

                Mail::send('emails.resetPassword', ['data' => $data], function ($message) use ($data) {
                    $message->from(env('SUPPORT_EMAIL'), env('SUPPORT_NAME'))
                        ->to($data['email'])
                        ->subject('Contact Us');
                });
                return redirect('signin');
            }
        }
        return redirect('signin');
    }

    public function logout(){
        Auth::logout();
        return redirect('signin');
    }

    public function get_reset_password($token){
        $users = User::get();
        foreach ($users as $user)
        {
            $password = md5($user->password);
            $email = md5($user->email);
            if ($password == $token){

                return redirect('resetView/'.$email);
            }
        }
        return view('signup');
    }
   
    public function post_reset_password(Request $request){

        $email =  $request->input('email');
        $users = User::get();
        foreach ($users as $user) {
            if ($email == md5($user->email)) {
                $password = $request->input('password');
                if(password_verify($password , $user->password))
                {
                    Session::flash('password_error', 'Something Wrong! Other Password');
                    return redirect('resetView/'.$email);
                }
                $user->password = bcrypt($password);
                $user->save();
                return redirect('signin');
            }
        }
        return redirect('signin');
    }

    public function check_email(Request $request) {
        $email = $request->input('email');
        $get = User::where('email', $email)->get();
        return count($get) ? 'duple' : 'success';
    }
}
