<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Profile;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Paypal;
use App\Models\Visa;

class TransactionController extends Controller
{
    public function __construct(){
        
    }

    
    private function getTransactions($start, $end) {
        $user_id = $this->getUserid();
        $transactions = Transaction::where('user_id', '=', $user_id)
                        ->where('created_at', '>=', $start)
                        ->where('created_at', '<=', $end)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return $transactions;
    }

    private function getTransactionAll() {
        $user_id = $this->getUserid();
        $transactions = Transaction::where('user_id', '=', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $transactions;
    }

    private function getInvoices($start, $end) {
        $user_id = $this->getUserid();
        $invoices = Invoice::where('user_id', '=', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return $invoices;
    }

    public function summary_today() {
        $start = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y")));
        $end = date('Y-m-d H:i:s', mktime(23, 59, 59, date("m"), date("d"), date("Y")));
        $data['main'] = $this->getTransactions($start, $end);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        return view('user.summary', ['data' => $data]);
    }

    public function summary_complete() {
        $data['main'] = $this->getTransactionAll();
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        return view('user.summary', ['data' => $data]);
    }

    public function summary(Request $request) {
        $from = $request->input('from');
        $from = date_create($from);
        $to = $request->input('to');
        $str = strtotime($to);
        $str = $str + 86399;
        $to = date('Y-m-d H:i:s', $str);
        $data['main'] = $this->getTransactions($from, $to);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        return view('user.summary', ['data' => $data]);
    }

    public function recordTransaction() {

        $user_id = $this->getUserid();
        $ip = $_SERVER['REMOTE_ADDR'];
        $location = '';
        $postcode = '';

        $transaction = new Transaction();
        $transaction->ip = $ip;
        $transaction->user_id = $user_id;
        $transaction->save();
        
    }

    public function checkAccessRight() {

        $user_id = $this->getUserid();
        $profile =  $this->getProfile();
        $plan = $profile->plan;
        $date = $profile->updated_at;

        if ($plan == 'Free')
        {
            $count = Transaction::where('user_id',$user_id)
                ->where('created_at','>=',$date)
                ->count();

            if ($count >= 500){

                return false;
            }
        }

        return true;
    }

    public function summary_download(Request $request) {
        $from = $request->input('from');
        $from = date_create($from);
        $to = $request->input('to');
        $to = date_create($to);
        $data['main'] = $this->getTransactions($from, $to);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        
        //Excel
		/*
        $path = $this->getContentsPath();

        $template = $path . '/blank.xlsx';
        $fileName = date('Ymd') . "_" . rand(1000, 99999) . '_' . 'summary.csv';
        $file = $path . '/download/' . $fileName;
        copy($template, $file);
        $reader = new PHPExcel_Reader_Excel2007();
        $writer = new PHPExcel_Writer_CSV($reader->load($file));
        $sheet = $writer->getPHPExcel()->getActiveSheet();
        $departModel = $this->getModel('Model_Depart');
        $grades = $this->getModel('Business_Model_Grade')->readData();

        $sheet->getCellByColumnAndRow(0, 1)->setValue('번호');
        $sheet->getCellByColumnAndRow(1, 1)->setValue('이름');
        $sheet->getCellByColumnAndRow(2, 1)->setValue('부서');
        $j = 3;
        foreach ($grades as $grade) {
            $sheet->getCellByColumnAndRow($j, 1)->setValue($grade['name']);
            $j++;
        }
        $sheet->getCellByColumnAndRow($j, 1)->setValue('계');

        $i = 2;
        foreach ($data as $row) {
            $sheet->getCellByColumnAndRow(0, $i)->setValue($i - 1);
            $sheet->getCellByColumnAndRow(1, $i)->setValue($row['name']);
            $sheet->getCellByColumnAndRow(2, $i)->setValue($departModel->getName($row['departId']));
            $j = 3;
            foreach ($grades as $grade) {
                $val = $row['current_' . $grade['id']];
                $sheet->getCellByColumnAndRow($j, $i)->setValue($val == 0 ? '' : $val);
                $j++;
            }
            $sheet->getCellByColumnAndRow($j, $i)->setValue($row['currentSum']);
            $i++;
        }
        $writer->save($file);

        $realFileName = $this->getRequest()->getParam('fileName');
        $file = implode( DIRECTORY_SEPARATOR, array( ROOT_PATH, $this->getConfigIni( 'app', 'print_path' ) ) ) . $fileName;
        $this->download($file, $realFileName, 'application/ms-excel');
		*/

        return view('user.summary', ['data' => $data]);
    }

    public function test(Request $request) {

        $tet = $request->input('where');

        $start = '';
        $end = '';
        $data['main'] = $this->getInvoices($start, $end);
        $profile = $this->getProfile();
        $data['username'] = $profile['firstname'];
        $card_number = Visa::where('profile_id', $profile->id)
            ->select(
                'visa.card_number'
            )->first();
        $data['card_number'] = $card_number->card_number;
        return $data;
    }

}
