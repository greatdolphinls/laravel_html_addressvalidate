<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Visa;
use App\Models\Paypal;
use App\Models\Invoice;


class AccountController extends Controller
{

    private function getVisa() {
        return $this->getProfile()->Visa;
    }

    private function getPaypal() {
        return $this->getProfile()->Paypal;
    }

    private function getInvoices() {
        $user_id = $this->getUserid();
        return Invoice::where('user_id', '=', $user_id)->get();
    }

    private function getUnpaidInvoices() {
        $user_id = $this->getUserid();
        return Invoice::where('user_id', '=', $user_id)
                        ->where('status', '!=', 'PAID')->get();
    }

    private function getPaidInvoices() {
        $user_id = $this->getUserid();
        return Invoice::where('user_id', '=', $user_id)
                        ->where('status', '=', 'PAID')
                        ->orderBy('start_time', 'desc')
                        ->get();
    }

    public function account() {
//        $where = $request->route('where');
        $profile = $this->getProfile();
        if ($profile['pay_method'] == 'visa') {
            $billing = $this->getVisa();
        }
        if ($profile['pay_method'] == 'paypal') {
            $billing = $this->getPaypal();
        }
        $profile['username'] = $profile['firstname'];
        $profile['where'] = Session::get('where');
        return view('user.account', ['data' => $profile, 'billing' => $billing]);
    }

    public function update_account(Request $request) {
        $company_name = $request->input('company_name');
        $contact_name = $request->input('contact_name');
        $phone_number = $request->input('phone_number');
        $email_address = $request->input('email_address');

        list($first, $last) = preg_split('/ /', $contact_name);

        $profile = $this->getProfile();
        $profile->company_name = $company_name;
        $profile->firstname = $first;
        $profile->lastname = $last;
        $profile->phone_number = $phone_number;
        $profile->website_domain = $email_address;

        $profile->save();
        return redirect('account');
    }

    public function change_password(Request $request) {
        $user_id = $this->getUserid();
        $old_password = $request->input('old_password');
        $new_password = bcrypt($request->input('new_password'));
        $user = User::find($user_id);
        if(!password_verify($old_password , $user->password)) {
            return 'wrong';
        }
        $user->password = $new_password;
        $user->save();
        return 'success';
    }

    public function change_plan(Request $request) {
        $user_id = $this->getUserid();
        $new_plan = $request->input('new_plan');
        $current_plan = $request->input('current_plan');
        $profile = User::find($user_id)->Profile;
        $profile->plan = $new_plan;
        $profile->save();
        $invoices = $this->getInvoices();
        if($current_plan == 'Free') {
            $invoice = new Invoice;
            $invoice->user_id = $user_id;
            $invoice->start_time = date('YmdHis');
            $invoice->end_time = date('YmdHis', strtotime('+30 days'));
            $invoice->status = 'DUE';
            if($new_plan == "Business-Monthly") {
                $invoice->amount = 99;
            }
            if($new_plan == "Business-Yearly") {
                $invoice->amount = 1000;
            }
            if($new_plan == "Enterprise") {
                $invoice->amount = 2000;
            }
            $invoice->save();
        }
        else {
            $invoice = new Invoice;
            $invoice->user_id = $user_id;
            $invoice->status = 'DUE';
            if($current_plan == 'Business-Monthly' && $new_plan == 'Business-Yearly') {
                $invoice->amount = 901;
            }
            if($current_plan == 'Business-Monthly' && $new_plan == 'Enterprise') {
                $invoice->amount = 1901;
            }
            if($current_plan == 'Business-Yearly' && $new_plan == 'Enterprise') {
                $invoice->amount = 1000;
            }
            $paid_invoices = $this->getPaidInvoices();
            $unpaid_invoices = $this->getUnpaidInvoices();
            if(empty($unpaid_invoices)){
                $invoice->start_time = $paid_invoices[0]->start_time;
                $invoice->end_time = $this->addDate($paid_invoices[0]->start_time, 0, 0, 1);
            }
            else {
                $invoice->start_time = $unpaid_invoices[0]->start_time;
                $invoice->end_time = $this->addDate($unpaid_invoices[0]->start_time, 0, 0, 1);
            }
            $invoice->save();
        }

        return 'success';
    }
    
    public function change_billing(Request $request) {
        $is_visa = $request->input('visaRadio');
        if($is_visa) {
            $visa = $this->getVisa();
            if(empty($visa)){
                $visa = new Visa;
            }
            //echo $request; die;
            $visa->profile_id = $this->getProfile()->id;
            $visa->card_number =  $request->input('cardNumber');
            $visa->security_code =  $request->input('securityCode');
            $visa->expires1 =  $request->input('expires1');
            $visa->expires2 =  $request->input('expires2');
            $visa->salutation = $request->input('salutation');
            $visa->firstname = $request->input('cardFirstName');
            $visa->lastname = $request->input('cardLastName');
            $visa->alert1 =  $request->input('billingAlert');
            $visa->alert2 =  $request->input('sevenDayAlert');
            $visa->save();
            $profile = $this->getProfile();
            $profile->pay_method = 'visa';
            $profile->save();
        }
        else 
        {

            $paypal = $this->getPaypal();
            if(empty($paypal)){
                // echo 'paypal here'; die;
                $paypal = new Paypal;
            }
            $paypal->profile_id = $this->getProfile()->id;
            $paypal->paypal_email =  $request->input('paypalEmail');
            $paypal->alert1 =  $request->input('billingAlert');
            $paypal->alert2 =  $request->input('sevenDayAlert');
            $paypal->save();

            $profile = $this->getProfile();
            $profile->pay_method = 'paypal';
            $profile->save();
        }
    
        return 'success';
    }
}
