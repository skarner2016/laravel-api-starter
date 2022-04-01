<?php

namespace App\Repository;

use App\Models\CommentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentRepository
{
    /**
     * @desc    评论列表
     * @param int $topicId
     * @param int $commentId
     * @param int $perPage
     * @param int $currentPage
     * @return LengthAwarePaginator
     * @author  skarner <2022-04-01 10:48>
     */
    public static function paginate(int $topicId, int $commentId, int $perPage, int $currentPage): LengthAwarePaginator
    {
        return CommentModel::query()
            ->with(['user', 'replyUser'])
            ->where('topic_id', $topicId)
            ->when($commentId, function ($query) use ($commentId) {
                $query->where('root_comment_id', $commentId);
            }, function ($query) {
                $query->where('root_comment_id', CommentModel::ROOT_COMMENT_ID_ZERO);
            })
            ->orderBy('id')
            ->paginate($perPage, ['*'], 'page', $currentPage);
    }
}
