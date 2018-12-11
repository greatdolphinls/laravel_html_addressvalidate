<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Support\Facades\Session;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected function getUserid() {
        $role = Session::get('role');
        if($role == 'admin')
            return Session::get('admin_user_id');
        else if($role == 'user')
            return Session::get('userid');
    }

    protected function getProfile() {
        $user_id = $this->getUserid();
        return User::find($user_id)->profile;
    }

    public function addDate($givendate,$day=0,$mth=0,$yr=0) {
        $cd = strtotime($givendate);
        $newdate = date('Y-m-d H:i:s', mktime(date('H',$cd),
        date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
        date('d',$cd)+$day, date('Y',$cd)+$yr));
        return $newdate;
    }

    public function getContentsPath() {
        return dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '../../../contents';
    }

    public function download ($filePath, $fileName = null, $contentType = 'application/octet-stream', $isAttachment = true) {
        $part_paths = pathinfo($filePath);
        if (! file_exists($filePath) || ! is_file($filePath)) {
            die();
        }
        if ($fileName == null) {
            if (@ereg('[a-zA-Z0-9]\.', $filePath)) {
                $fileName = $part_paths['basename'];
            } else {
                $fileName = 'download_' . mktime() . '.' . $part_paths['extension'];
            }
        }
        header('Pragma: cache');
        header('Accept-Ranges:bytes');
        header('Cache-Control: cache');
        if ($isAttachment) header('Content-Disposition: attachment;');
        header('filename="' . $fileName . '"');
        header('Content-Type: '.$contentType.'; name="' . $fileName . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        ob_clean();
        flush();
        readfile($filePath);
        exit();
    }
}
