<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User ;
use App\Models\Profile ;
use App\Models\Invoice ;
use App\Models\Transaction ;
use App\Models\Visa ;
use App\Models\Paypal ;
use Auth;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use URL;

class AdminMissionController extends Controller
{
    public  function admin(){
        $missions= Profile::select(
            'profiles.id',
            'profiles.company_name',
            'profiles.plan',
            'profiles.pay_method',
            'profiles.user_id'
        )->get();
        foreach($missions as $mission) {
            $billingData = Invoice::orderBy('invoices.created_at', 'desc')
                ->where('invoices.user_id', $mission['user_id'])
                ->select(
                    'invoices.created_at',
                    'invoices.status',
                    'invoices.start_time',
                    'invoices.end_time'
                )->first();
            $mission['billing_time'] = $billingData['created_at'];
            $mission['status'] = $billingData['status'];
            $mission['start_time'] = $billingData['start_time'];
            $mission['end_time'] = $billingData['end_time'];
            $mission['invoices'] = Invoice::orderBy('invoices.created_at', 'desc')
                ->where('invoices.user_id', $mission['user_id'])
                ->get();
            $mission['count'] = Transaction::where('transactions.user_id', $mission['user_id'])
                ->count();
            $mission['img'] = substr($mission['company_name'], 0,1);
            $user= User::find($mission['user_id']);
            $mission['email'] = $user->email;
            $current_time = date('Y-m-d H:i:s');
            $last = date_diff(date_create($current_time), date_create($mission['start_time']));
            $lastdays = $last->days <= 0 ? 1 : $last->days;
            $mission['count'] = floor($mission['count']/$lastdays);

        }
        return view('admin.mission')->with('missions', $missions);
    }

    public function suspendClient($id){

       $profile= Profile::find($id);
       $user = User::find($profile->user_id);
       $user->block = false;
       $user->save();
        return redirect('admin');
    }

    public function suspendAllApi($id){

       $user = User::find($id);
       $user->block = false;
       $user->save();

        return redirect('admin');
    }

    public function removeClient($id){

        Invoice::where('user_id',$id)->delete();
        Transaction::where('user_id',$id)->delete();
        Visa::where('profile_id',$id)->delete();
        Paypal::where('profile_id',$id)->delete();
        $profile = Profile::find($id);
        Profile::destroy($id);
        User::destroy($profile->user_id);
        return redirect('admin');
    }

    public  function downgrade(Request $request){
        $id = $request->input('id');
        $plan_level = "level".$id;
        $plan_period = "period".$id;
        $level = $request->input($plan_level);
        $period = $request->input($plan_period);
        $profile = Profile::find($id);
        switch ($level) {
            case 'Free':
                $profile->plan = $level;
                $profile->pay_method = "N/A";
                break;
            case 'Business':
                $profile->plan = $level.'-'.$period;
                $profile->pay_method = "paypal";
                break;
            case 'Enterprise':
                $profile->plan = $level;
                $profile->pay_method = "visa";
                break;
        }
        $profile->save();
        return redirect('admin');

    }
    //send email
    public  function resetPassword(Request $request){

        $id = $request->input('id');
        $email = $request->input('email');
        $profile = Profile::find($id);
        $user = User::find($profile->user_id);
       
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

        return redirect('admin');

    }

    public  function apiExpiry(Request $request){
        $id = $request->input('id');
        $start_time = "start_time".$id;
        $end_time = "end_time".$id;
        $invoice = Invoice::orderBy('invoices.created_at', 'desc')
            ->where('invoices.user_id', $id)
            ->first();
        $from = $request->input($start_time);
        $from = date_create($from);
        $to = $request->input($start_time);
        $to = date_create($to);

        $invoice->start_time = $from;
        $invoice->end_time = $to;
        $invoice->save();
        return redirect('admin');
    }

    public function viewStatistic($id){
        Session::put('admin_user_id', $id);
        return redirect('dashboard');
    }

    public function viewTransactions($id){
        Session::put('admin_user_id', $id);
        return redirect('summary_today');
    }

    public function editClient($id){
        Session::put('admin_user_id', $id);
        Session::put('where', 'Details');
        return redirect('account');   
    }

    public function editBilling($id){
        Session::put('admin_user_id', $id);
        Session::flash('where', 'Billing');
        return redirect('account');
    }

}
