<?php

namespace App\Http\Controllers\Api;

use App\Lib\Api;
use App\Lib\Code;
use App\Services\TopicService;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Requests\Api\CommentRequest;

class CommentsController extends Controller
{
    /**
     * @desc    评论/回复列表
     * @author  skarner <2022-04-01 10:53>
     */
    public function index(CommentRequest $request)
    {
        $topicId     = $request->input('topic_id');
        $commentId   = $request->input('comment_id', 0);
        $perPage     = $request->input('per_page');
        $currentPage = $request->input('current_page');

        $paginate = CommentService::paginate($topicId, $commentId, $perPage, $currentPage);

        return Api::success(CommentResource::collection($paginate));
    }

    /**
     * @desc    发表评论/回复
     * @author  skarner <2022-04-01 11:49>
     */
    public function store(CommentRequest $request)
    {
        $topicId   = $request->input('topic_id');
        $commentId = $request->input('comment_id', 0);
        $content   = $request->input('content');

        // 主题
        if (!$topic = TopicService::findById($topicId)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        // 评论/回复
        if ($commentId) {
            if (!$comment = CommentService::findById($commentId)) {
                return Api::fail(Code::PARAM_ERROR);
            }
        }

        $ip            = $request->getClientIp();
        $replyUserId   = $commentId ? $comment->user_id : $topic->user_id;
        $rootCommentId = 0;
        if ($commentId) {
            $rootCommentId = $comment->root_comment_id == 0 ? $commentId : $comment->root_comment_id;
        }

        // TODO:
        $userId = 1;
        CommentService::create([
            'user_id'          => $userId,
            'topic_id'         => $topicId,
            'reply_comment_id' => $commentId ?: 0,
            'reply_user_id'    => $replyUserId,
            'root_comment_id'  => $rootCommentId,
            'content'          => $content,
            'ip'               => $ip,
            'device_id'        => 'device_id',
        ]);

        return Api::success();
    }

    /**
     * @desc    修改评论/回复内容
     * @author  skarner <2022-04-01 14:22>
     */
    public function update(CommentRequest $request, $id)
    {
        $content   = $request->input('content');

        if (!$comment = CommentService::findById($id)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        $commentData = ['content' => $content];
        CommentService::update($id, $commentData);

        return Api::success();
    }

    /**
     * @desc    删除(软)评论/回复
     * @author  skarner <2022-04-01 14:11>
     */
    public function destroy($id)
    {
        if (!$comment = CommentService::findById($id)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        CommentService::delete($id);

        return Api::success();
    }
}
