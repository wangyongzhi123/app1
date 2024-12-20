<?php

namespace App\Service\YunComment;

use App\Models\YunUser;
use App\Service\ReturnService;
use App\Service\SendRequestService;
use Illuminate\Support\Facades\Cache;

class YunCommentService extends YunCommentRealizeService
{
    public function __construct(){
        parent::__construct();
    }
    public function getHeaderCacheName()
    {
        return 'yun_comment_header';
    }
    public function setHeaderCacheName($value)
    {
        Cache::put($this->getHeaderCacheName(), $value, 3600*12);//缓存12h
    }
    public function getComment($commentUrl)
    {
        $sendUrl    = new SendRequestService('get', $commentUrl, 100);
        $data       = $sendUrl->sendGetRequest();
        //dd($data);
        if ($data['code'] == 200) {
            //记录header参数
            $this->setHeaderCacheName($sendUrl->header);
            return ReturnService::success($this->formatComment($data['result']));
        }
        return ReturnService::error($data['message']);
    }
    public function formatComment($data)
    {
        $userInfoFuc = function ($userId){
            $userInfo = [];
            $yunUser = YunUser::where('user_id',$userId)->first();
            if($yunUser){
                $userInfo = $yunUser->toArray();
            }
            $userName = $userInfo ? $userInfo['user_name'] : ($data['user']['userName'] ?? '');
            $avatar = $userInfo ? $userInfo['avatar'] : ($data['user']['avatar'] ?? '');

            return ['userName'=>$userName,'avatar'=>$avatar];
        };

        $list = empty($data['list'])  ? [] :$data['list'];
        foreach ($list as $key => &$item){
            if(isset($item['commentUser'])){
                $user = $userInfoFuc($item['commentUser']['userId']);
                $item['commentUser']['avatar'] = $user['avatar'];
                $item['commentUser']['userName'] = $user['userName'];
            }

            if(!empty($item['replyList'])){
                foreach ($item['replyList'] as $_key=>$_value){
                    $user = $userInfoFuc($_value['toUser']['userId']);
                    $_value['toUser']['avatar'] = $user['avatar'];
                    $_value['toUser']['userName'] = $user['userName'];

                    $user = $userInfoFuc($_value['fromUser']['userId']);
                    $_value['fromUser']['avatar'] = $user['avatar'];
                    $_value['fromUser']['userName'] = $user['userName'];

                    $item['replyList'][$_key] = $_value;
                }
            }
        }
        return $list;
    }
}
