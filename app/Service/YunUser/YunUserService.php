<?php

namespace App\Service\YunUser;

use App\Models\YunUser;
use App\Service\ReturnService;
use App\Service\SendRequestService;
use App\Service\YunComment\YunCommentService;
use App\Service\YunFeed\YunFeedService;
use Illuminate\Support\Facades\Cache;

class YunUserService extends YunUserRealizeService
{
    protected $url;
    protected $pageSize = 3500;
    public function __construct(){
        parent::__construct();
    }
    public function getUser($url)
    {
        $this->url = $url;
        $sendUrl = new SendRequestService('get',$url,$this->pageSize);
        $data = $sendUrl->sendGetRequest();
        //dd($data);
        if ($data['code'] == 200) {
            return ReturnService::success($this->saveData($data['result']));
        }else{
            $result = $this->retryRequestUseHeader(Cache::get((new YunFeedService())->getHeaderCacheName(),[]));
            if(!$result['code'] != 200){
                return $this->retryRequestUseHeader(Cache::get((new YunCommentService())->getHeaderCacheName(),[]));
            }
        }
        return ReturnService::error($data['message']);
    }
    public function retryRequestUseHeader($header)
    {
        $sendUrl = new SendRequestService('get',$this->url,$this->pageSize);
        //更换header
        $sendUrl->header = $header;
        //dd($header);
        $data = $sendUrl->sendGetRequest();
        if ($data['code'] == 200) {
            return ReturnService::success($this->saveData($data['result']));
        }
        return ReturnService::error($data['message']);
    }
    public function saveData($data)
    {
        //dd($data);
        // TODO: Implement save() method.
        $commonData = [];
        $list = empty($data['list'])  ? [] :$data['list'];
        foreach ($list as $value) {
            $commonData[] = [
                'user_id'      => $value['userId'],
                'rank'         => $value['rank'],
                'user_name'    => $value['userName'],
                'dept_name'    => $value['deptName'] ?? '',
                'change_score' => $value['changeScore'] ?? 0,
                'deduct_score' => $value['deductScore'] ?? 0,
                'add_score'    => $value['addScore'] ?? 0,
                'avatar'       => $value['avatar'] ?? ''
            ];
        }
        if ($commonData) {
            try {
                $singField   = ['user_id'];
                $updateField = ['rank', 'user_name', 'dept_name', 'change_score', 'deduct_score', 'add_score', 'avatar'];
                YunUser::upSert($commonData, $singField, $updateField);
            } catch (\Exception $e) {
                return ['status' => false, 'msg' => $e->getMessage()];
            }

        }
        return ['status' => true, 'total' => count($commonData)];

    }

}
