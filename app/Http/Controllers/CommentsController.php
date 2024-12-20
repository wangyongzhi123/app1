<?php

namespace App\Http\Controllers;

use App\Service\CommentService;
use App\Service\YunComment\YunCommentService;
use App\Service\YunFeed\YunFeedService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getFeed(Request $request)
    {
        $params = $request->all();
        if (!empty($params['comment_url'])) {
            $commentReplyResult = (new YunCommentService())->getComment($params['comment_url']);
            $commentReply       = $commentReplyResult['status'] ? $commentReplyResult['data'] : [];
        }
        if (!empty($params['feed_url'])) {
            $feedResult = (new YunFeedService())->getFeed($params['feed_url']);
            $feed       = $feedResult['status'] ? $feedResult['data'] : [];
        }
        $data = ['feed' => $feed ?? [], 'comments' => $commentReply ?? [], 'commentUrl' => $params['comment_url'] ?? '', 'feedUrl' => $params['feed_url'] ?? ''];
        return view('comments', $data);
    }

}
