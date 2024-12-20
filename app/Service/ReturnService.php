<?php

namespace App\Service;

class ReturnService
{
    public static function error($message='',$code=400)
    {
        return ['status' => false, 'message' => $message,'code'=>$code];
    }
    public static function success($data=[],$code=200)
    {
        return ['status' => true, 'data' => $data,'code'=>$code];
    }
}
