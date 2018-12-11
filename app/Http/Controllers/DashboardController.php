<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Profile;
use App\Models\Invoice;
use App\Models\Transaction;

class DashboardController extends Controller
{
    //
    private function freeData() {
        $result = [];
        $user_id = $this->getUserid();

        $today = date_create(date('Y-m-d'));
        $profile = $this->getProfile();
        $create = $profile['created_at'];
        $interval = date_diff($today, $create);
        $days = $interval->days == 0 ? 1 : $interval->days;

        $transaction = count(User::find($user_id)->transactions);
        $average = floor($transaction / $days);

        $result['username'] = $profile['firstname'];
        $result['plan'] = 'Free';
        $result['transaction_cnt'] = $transaction;
        $result['remain_cnt'] = 500 - $transaction;
        $result['percent'] = $transaction / 500 * 100;
        $result['average'] = $average;

        return $result;
    }

    private function businessData($plan) {
        $result = [];
        $user_id = $this->getUserid();

        // username
        $profile = $this->getProfile();
        $result['username'] = $profile['firstname'];

        // plan
        $result['plan'] = $plan;

        // last day
        // remain day
        $invoice = Invoice::where('user_id', '=', $user_id)
            ->orderBy('end_time', 'desc')
            ->get();

        if(count($invoice) == 0){
            $result['lastdays'] = 0;
            $result['remaindays'] = 0;
            $result['percent'] = 0;
            $result['end_time'] = 0;
            $result['transaction_cnt'] = 0;
            $result['average'] = 0;
            return $result;
        }

        $start_time = $invoice[0]['start_time'];
        $end_time = $invoice[0]['end_time'];
        $current_time = date('Y-m-d H:i:s');
        $last = date_diff(date_create($current_time), date_create($start_time));
        $lastdays = $last->days == 0 ? 1 : $last->days;
        $remain = date_diff(date_create($end_time), date_create($current_time));
        $remaindays = $remain->days == 0 ? 1 : $remain->days;
        $diff = date_diff(date_create($end_time), date_create($start_time));
        $diffdays = $diff->days == 0 ? 1 : $diff->days;
        $result['lastdays'] = $lastdays;
        $result['remaindays'] = $remaindays;
        $result['percent'] = round($lastdays / $diffdays * 100);
        $result['end_time'] = $end_time;

        // total_calls
        $transactions = Transaction::where('user_id', '=', $user_id)
            ->where('created_at', '>=', $start_time)
            ->where('created_at', '<=', $end_time)
            ->get();
        $result['transaction_cnt'] = count($transactions);

        // average_calls
        $result['average'] = floor($result['transaction_cnt'] / $lastdays);
        return $result;
    }

    private function enterpriseData() {
        $result = [];
        $user_id = $this->getUserid();

        // username
        $profile = $this->getProfile();
        $result['username'] = $profile['firstname'];

        // plan
        $result['plan'] = 'Enterprise';

        // last day
        // remain day
        $invoice = Invoice::where('user_id', '=', $user_id)
            ->orderBy('end_time', 'desc')
            ->get();

        if(count($invoice) == 0){
            $result['lastdays'] = 0;
            $result['remaindays'] = 0;
            $result['percent'] = 0;
            $result['end_time'] = 0;
            $result['transaction_cnt'] = 0;
            $result['average'] = 0;
            return $result;
        }

        $start_time = $invoice[0]['start_time'];
        $end_time = $invoice[0]['end_time'];
        $current_time = date('Y-m-d H:i:s');
        $last = date_diff(date_create($current_time), date_create($start_time));
        $lastdays = $last->days == 0 ? 1 : $last->days;
        $remain = date_diff(date_create($end_time), date_create($current_time));
        $remaindays = $remain->days == 0 ? 1 : $remain->days;
        $diff = date_diff(date_create($end_time), date_create($start_time));
        $diffdays = $diff->days == 0 ? 1 : $diff->days;
        $result['lastdays'] = $lastdays;
        $result['remaindays'] = $remaindays;
        $result['percent'] = round($lastdays / $diffdays * 100);
        $result['end_time'] = $end_time;

        // total_calls
        $transactions = Transaction::where('user_id', '=', $user_id)
            ->where('created_at', '>=', $start_time)
            ->where('created_at', '<=', $end_time)
            ->get();
        $result['transaction_cnt'] = count($transactions);

        // average_calls
        $result['average'] = floor($result['transaction_cnt'] / $lastdays);
        return $result;
    }

    public function dashboard() {
        $profile = $this->getProfile();
        $plan = $profile['plan'];
        $data = [];
        switch ($plan) {
            case 'Free':
                $data = $this->freeData(); break;
            case 'Business-Monthly' :
            case 'Business-Yearly' :
                $data = $this->businessData($plan); break;
            case 'Enterprise' :
                $data = $this->enterpriseData(); break;
        }
        return view('user.index', ['data' => $data]);
    }
}
