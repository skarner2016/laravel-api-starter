<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentModel extends BaseModel
{
    protected $table = 'comments';

    const IS_DIGEST_FALSE = 0; // 非精选评论
    const IS_DIGEST_TRUE  = 1; // 精选评论

    const ROOT_COMMENT_ID_ZERO = 0;

    /**
     * @desc    工厂实例
     * @return CommentFactory|Factory
     * @author  skarner <2022-03-30 11:31>
     */
    protected static function newFactory(): Factory|CommentFactory
    {
        return CommentFactory::new();
    }

    /**
     * @desc    评论属于用户
     * @return BelongsTo
     * @author  skarner <2022-03-31 17:28>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    /**
     * @desc    评论的对象
     * @return BelongsTo
     * @author  skarner <2022-04-01 11:32>
     */
    public function replyUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'reply_user_id');
    }
}
