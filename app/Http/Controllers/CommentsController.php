<?php

namespace App\Http\Controllers;

use App\Service\CommentService;
use App\Service\SendRequestService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getFeed(Request $request)
    {
        $params  = $request->all();
        $comment = new CommentService();
        if (!empty($params['comment_url'])) {
            $commentUrl = $params['comment_url'];
            $sendUrl    = new SendRequestService('get', $commentUrl, 100);
            $data       = $sendUrl->sendGetRequest();
            if ($data['status']) {
                $_data        = is_array($data['data']) ? $data['data'] : json_decode($data['data'], 1);
                $commentReply = $comment->formatComment($_data);
            }
        }
        if (!empty($params['feed_url'])) {
            $feedUrl = $params['feed_url'];
            $sendUrl = new SendRequestService('get', $feedUrl);
            $data    = $sendUrl->sendGetRequest();
            $_data   = is_array($data['data']) ? $data['data'] : json_decode($data['data'], 1);
            if ($data['status']) {
                $feed = $comment->formatFeed($_data);
            }
        }
        //dd($commentReply);
        $data = ['feed' => $feed ?? [], 'comments' => $commentReply ?? [],'commentUrl'=>$commentUrl ?? '','feedUrl'=>$feedUrl ?? ''];
        return view('comments', $data);
    }

}
