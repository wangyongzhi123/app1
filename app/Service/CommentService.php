<?php

namespace App\Service;

use App\Models\YunUser;

class CommentService
{
    public function formatFeed($data)
    {
        $data = $data['result'] ?? [];
        $newData = [];

        if($data){
            $userInfo = [];
            $yunUser = YunUser::where('user_id',$data['user']['userId'])->first();
            if($yunUser){
                $userInfo = $yunUser->toArray();
            }
            $userName = $userInfo ? $userInfo['user_name'] : ($data['user']['userName'] ?? '');
            $avatar = $userInfo ? $userInfo['avatar'] : ($data['user']['avatar'] ?? '');
            //dd($userInfo);
            $newData = [
                'id' => $data['id'],
                'user'=>[
                    'userId'=>$data['user']['userId'],
                    'nickname'=>$data['user']['nickname'],
                    'userName'=>$userName,
                    'avatar'=>$avatar,
                ],
                'topicContent'=>[
                    'title'=>$data['title'] ?? '',
                    'content'=>$data['content'],
                    'mediaType'=>$data['mediaType'],//0是图片
                    'lastActionTime'=>$data['lastActionTime'] ?? '',
                    'lastCommentTime'=>$data['lastCommentTime'] ?? '',
                    'readNum'=>$data['readNum'],
                    'likeNum'=>$data['likeNum'],
                    'commentNum'=>$data['commentNum'],
                    'createTime'=>$data['createTime'],
                    'imageOriginals'=>$data['imageOriginals'] ?? [],
                ],
            ];
        }
        return $newData;
    }

    public function formatComment($data)
    {
        $data = $data['result']['list'] ?? [];
//        dd($data);
        $userInfoFuc = function ($userId){
            $yunUser = YunUser::where('user_id',$userId)->first();
            if($yunUser){
                $userInfo = $yunUser->toArray();
            }
            $userName = $userInfo ? $userInfo['user_name'] : ($data['user']['userName'] ?? '');
            $avatar = $userInfo ? $userInfo['avatar'] : ($data['user']['avatar'] ?? '');

            return ['userName'=>$userName,'avatar'=>$avatar];
        };


        foreach ($data as $key => &$item){
           $user = $userInfoFuc($item['commentUser']['userId']);
            //dd($user);
            $item['commentUser']['avatar'] = $user['avatar'];
            $item['commentUser']['userName'] = $user['userName'];

            if(!empty($item['replyList'])){
                foreach ($item['replyList'] as $_key=>$_value){
                    $user = $userInfoFuc($_value['toUser']['userId']);
//                    dd($user);
                    $_value['toUser']['avatar'] = $user['avatar'];
                    $_value['toUser']['userName'] = $user['userName'];

                    $user = $userInfoFuc($_value['fromUser']['userId']);
                    $_value['fromUser']['avatar'] = $user['avatar'];
                    $_value['fromUser']['userName'] = $user['userName'];

                    $item['replyList'][$_key] = $_value;
                }
            }
        }
//        dd($data);
        return $data;
    }

}
