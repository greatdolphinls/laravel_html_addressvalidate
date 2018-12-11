<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use App\Models\Userinfo;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TransactionController;

class ValidAddressController extends Controller
{
    public $DELIMITER = "    ";
    
    public $QUERY_SPELLCORRECTION = 1;
    public $QUERY_PARSE = 2;
    public $QUERY_SYNONYM = 3;
    public $QUERY_AUTOCOMPLETION = 4;
    public $QUERY_REORDER = 5;
    
    public $RESULT_WHOLEADDRESS = 1;
    public $RESULT_NEXTWORD = 2;
    public $RESULT_SPELLCORRECTION = 3;
    
    public $STREETNUMBER = "num=";
    public $SUBURBS = "sb=";
    public $POSTCODE = "zip=";
    public $STATE = "state=";
    
    public $ERROR = 0;
    public $ERROR_CONNECT = -1;
    public $ERROR_const = "error";
    public $RESULT = "results";
    
    public $MAX_BUFFER_SIZE = 1024 * 1024;

    public function __contruct() {
        $this->middleware('auth:api');
    }

    public function checkRequest() {
        $userid = Session::get('userid');
        $role = Session::get('role');
        return ( isset($userid) && isset($role) ) ? true : false;
    }

    public function validAddress(Request $request) {

        $appid = $request->input('appid');
        $key = $request->input('key');

        $result = array(
            'code'      => 0,
            'result'    => array()
        );

        if (!$this->checkRequest()) {
            return json_encode($result);
        }

        $transaction = new TransactionController();
        $transaction->recordTransaction();
        if (!$transaction->checkAccessRight()){
            return json_encode($result);
        }
        if ($appid != null && $key != null) {

            if ($appid == "AVS" && $key == "AVS") {
                $request->session()->put('authorized', 'true');
                $result['code'] = 1;
            }
            return json_encode($result);
        }

        $code = -1;
        $query = "";

        $code = (int) ($request->input("code"));
        if ($code <= 0) {
            return json_encode($result);
        }

        $needParse = (strpos($request->input("code"), '2') != -1);
        $needGeoPos = (strpos($request->input("code"), '6') != -1);

        $query = $request->input("query");
        if ($query == null)
            return null;

        $query = trim($query);
        if (strlen($query) == 0) {
            return json_encode($result);
        }

        $oldCode = (int) $request->session()->get("code");

        if ($oldCode != null && $oldCode != $this->ERROR && $oldCode != $this->RESULT_NEXTWORD) {
            $oldResult = $request->session()->get("result");
            if ($oldResult != null) {
                $isSelected = false;
                for ($i = 0; $i < count($oldResult); $i++) {
                    $tempList = $oldResult[$i];
                    if ($tempList != null) {
                        $tempString = $tempList[0];
                        if ($tempString != null && $tempString == $query) {
                            $isSelected = true;
                            break;
                        }
                    }
                }

                if ($isSelected == true) {
                    if ($code == $this->QUERY_SPELLCORRECTION) {
                        return json_encode($result);
                    }

                    $code = (int)(str_replace($code, $this->QUERY_SPELLCORRECTION, ""));
                }
            }
        }

        // $query = '134562    abc';
        $packet = $code . $this->DELIMITER . $query;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ( !socket_connect($socket, env('ENGINE_SERVER'), env('ENGINE_PORT')) ) {
            $result['code'] = $this->ERROR_CONNECT;
            $result['result'] = null;
            return $result;
        }
        socket_write($socket, $packet, strlen($packet));// or die("Could not send data to server\n");
        flush();
        $resultWords = socket_read($socket, 1024);// or die("Could not read server response\n");

        socket_close($socket);
        // echo $resultWords;
        $numberOfBytes = strlen($resultWords);

        if (!$resultWords)
            $result['code'] = $this->ERROR;
        else {
            $result['code'] = (int)(substr($resultWords, 0, 1));
            $offset = 1;

            for ($i = 1; $i < $numberOfBytes; $i++) {
                if (ord(substr($resultWords, $i, 1)) == 10) {
                    $buffer = substr($resultWords, $offset, $i - $offset);
                    if ($buffer == null || strlen($buffer) == 0) {
                        $offset = $i + 1;
                        continue;
                    }

                    //$temp = new ArrayList<String>();
                    $temp = array();
                    if ($result['code'] == 1) {
                        //String wholeAddress = "";
                        // echo "here"; die;
                        $wholeAddress = $buffer;
                        $streetNumber = "";
                        $suburbNumber = "";
                        $postCode = "";
                        $state = "";
                        $latitude = 0;
                        $longitude = 0;

                        $wordOffset = 0;
                        $tempOffset = 0;
                        while (true) {
                            $tempOffset = strpos($buffer, "\t", $wordOffset);
                            //echo $tempOffset; die;
                            if ($tempOffset == false)
                                break;

                            if ($tempOffset - $wordOffset > 1) {
                                $word = substr($buffer, $wordOffset, $tempOffset);
                                if ($wordOffset == 0)
                                    $wholeAddress = $word;
                                else if (substr($word, 0, 1) == '1'){
                                    $temp_words = explode("\t", substr($word, 1));
                                    $streetNumber = $temp_words[0];
                                }
                                else if (substr($word, 0, 1) == '4'){
                                    $temp_words = explode("\t", substr($word, 1));
                                    $suburbNumber = $temp_words[0];
                                    // $suburbNumber = substr($word, 1);
                                }
                                else if (substr($word, 0, 1) == '6'){
                                    $temp_words = explode("\t", substr($word, 1));
                                    $postCode = $temp_words[0];
                                    // $postCode = substr($word, 1);
                                }
                                else if (substr($word, 0, 1) == '5'){
                                    $temp_words = explode("\t", substr($word, 1));
                                    $state = $temp_words[0];
                                    // $state = substr($word, 1);
                                }
                            }

                            $wordOffset = $tempOffset + 1;
                        }
                        try {
                            if ($postCode != "") {
                                $post_code = (int)($postCode);
                                $latitude = $post_code / 360;
                                $longitude = $post_code % 360;
                            }
                        } catch (Exception $e) {
                            //e.printStackTrace();
                        }

                        array_push($temp, $wholeAddress);
                        if ($needParse) {
                            array_push($temp, $streetNumber);
                            array_push($temp, $suburbNumber);
                            array_push($temp, $postCode);
                            array_push($temp, $state);
                        }
                        if ($needGeoPos) {
                            array_push($temp, $latitude);
                            array_push($temp, $longitude);
                        }

                    } else if ($result['code'] == 2) {
                        array_push($temp, $query.' '.$buffer);
                    } else {
                        array_push($temp, $buffer);
                    }
                    array_push($result['result'], $temp);

                    $offset = $i + 1;
                }
            }

        }

        $request->session()->put("code", $result['code']);
        if ($result['code'] != $this->ERROR) {
            $request->session()->put("result", $result['result']);
        }

        return json_encode($result);
    }
}
