<?php

namespace App\Service\YunFeed;

use App\Models\YunUser;
use App\Service\ReturnService;
use App\Service\SendRequestService;
use Illuminate\Support\Facades\Cache;

class YunFeedService extends YunFeedRealizeService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHeaderCacheName()
    {
        return 'yun_feed_header';
    }

    public function getFeed($commentUrl)
    {
        $sendUrl = new SendRequestService('get', $commentUrl, 100);
        $data    = $sendUrl->sendGetRequest();
        if ($data['code'] == 200) {
            //记录header参数
            Cache::put($this->getHeaderCacheName(), $sendUrl->header, 3600 * 12);//缓存12h
            return ReturnService::success($this->formatFeed($data['result']));
        }
        return ReturnService::error('获取失败');
    }

    public function formatFeed($data)
    {
        $newData = [];
        if ($data) {
            $userInfo = [];
            $yunUser  = YunUser::where('user_id', $data['user']['userId'])->first();
            if ($yunUser) {
                $userInfo = $yunUser->toArray();
            }
            $userName = $userInfo ? $userInfo['user_name'] : ($data['user']['userName'] ?? '');
            $avatar   = $userInfo ? $userInfo['avatar'] : ($data['user']['avatar'] ?? '');
            $newData = [
                'id'           => $data['id'],
                'user'         => [
                    'userId'   => $data['user']['userId'],
                    'nickname' => $data['user']['nickname'],
                    'userName' => $userName,
                    'avatar'   => $avatar,
                ],
                'topicContent' => [
                    'title'           => $data['title'] ?? '',
                    'content'         => $data['content'] ?? '',
                    'intro'           => $data['intro'] ?? '',
                    'richText'        => !empty($data['richText']) ? strip_tags($data['richText']) : '',
                    'mediaType'       => $data['mediaType'],//0是图片
                    'lastActionTime'  => $data['lastActionTime'] ?? '',
                    'lastCommentTime' => $data['lastCommentTime'] ?? '',
                    'readNum'         => $data['readNum'],
                    'likeNum'         => $data['likeNum'],
                    'commentNum'      => $data['commentNum'],
                    'createTime'      => $data['createTime'],
                    'imageOriginals'  => $data['imageOriginals'] ?? [],
                ],
            ];
        }
        return $newData;
    }

}
