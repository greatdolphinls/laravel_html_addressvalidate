<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Visa;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    //

    private function getInvoices($start, $end) {
        $user_id = $this->getUserid();
        $invoices = Invoice::where('user_id', '=', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $invoices;
    }

    public function invoice() {
        $start = '';
        $end = '';
        $data['main'] = $this->getInvoices($start, $end);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        $card_number = Visa::where('profile_id', $profile->id)
            ->select(
                'visa.card_number'
            )->first();
        $data['card_number'] = isset($card_number->card_number) ? $card_number->card_number : '';
        return view('user.invoice', ['data' => $data]);
    }

    public function pay_now(Request $request) {
        $card_number = $request->input('card_number');
        $invoice_id = $request->input('invoice_id');
        $invoice = Invoice::find($invoice_id);
        $invoice->status = 'PAID';
        ///Pay method require

        $invoice->save();
        return redirect('invoice');
    }
    
    public function save_pay(Request $request) {

        $card_number = $request->input('card_number');
        $expires1 = $request->input('expires1');
        $expires2 = $request->input('expires2');
        $security_code = $request->input('security_code');
        $salutation = $request->input('salutation');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $invoice_id = $request->input('invoice_id');
        $invoice = Invoice::find($invoice_id);
        $invoice->status = 'PAID';
        ///Pay method require

        $invoice->save();

        return redirect('invoice');
    }
    private function getInvoice($start, $end) {
        $user_id = $this->getUserid();
        Session::put('start_time',$start );
        Session::put('end_time', $end);
        $transactions = Invoice::where('user_id', '=', $user_id)
            ->Where(function($query)
            {

                $query->Where(function($query)
                {
                $start = Session::get('start_time');
                $end = Session::get('end_time');
                    $query->where('start_time', '>=', $start)
                          ->Where('start_time', '<=', $end);
                })
                    ->orWhere(function($query)
                    {
                        $start = Session::get('start_time');
                        $end = Session::get('end_time');
                        $query->where('end_time', '>=', $start)
                            ->Where('end_time', '<=', $end);
                    })
                    ->orWhere(function($query)
                    {
                        $start = Session::get('start_time');
                        $end = Session::get('end_time');
                        $query->where('start_time', '<=', $start)
                              ->Where('end_time', '>=', $end);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return $transactions;
    }

    public function invoice_during(Request $request) {
        $from = $request->input('from');
        $from = date_create($from);
        $to = $request->input('to');
        $to = date_create($to);
        $data['main'] = $this->getInvoice($from, $to);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        $card_number = Visa::where('profile_id', $profile->id)
            ->select(
                'visa.card_number'
            )->first();
        $data['card_number'] = isset($card_number->card_number) ? $card_number->card_number : '';

        return view('user.invoice', ['data' => $data]);
    }
}
