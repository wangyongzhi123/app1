<?php

namespace App\Http\Controllers;

use App\Service\SendRequestService;
use App\Service\YunUserService;
use Illuminate\Http\Request;

class yunUserController
{
    public function getRank(Request $request)
    {
        $params = $request->all();
        $saveRes = [];
        if(!empty($params['url'])){
            $url = $params['url'];
            $sendUrl = new SendRequestService('get',$url,30000);
            $data = $sendUrl->sendGetRequest();
            if($data['status']){
                $yunUser = new YunUserService();
                $_data = is_array($data['data']) ? $data['data'] : json_decode($data['data'],1);
                $saveRes = $yunUser->save($_data['result']);
            }
        }
        return view('yunUser',['saveRes'=>$saveRes,'url'=>$url ?? '']);
    }
}
