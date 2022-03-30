<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicModel extends BaseModel
{
    protected $table = 'topics';

    const IS_DIGEST_TRUE  = 1; // 是否精华：是
    const IS_DIGEST_FALSE = 0; // 是否精华：否

    const STATUS_NORMAL = 0; // 状态:正常
    const STATUS_DELETE = 1; // 状态:删除

    /**
     * @desc    工厂实例
     * @return TopicFactory|Factory
     * @author  skarner <2022-03-30 11:31>
     */
    protected static function newFactory(): Factory|TopicFactory
    {
        return TopicFactory::new();
    }

    /**
     * @desc    主题属于用户
     * @return BelongsTo
     * @author  skarner <2022-03-24 23:18>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id', 'user_id');
    }

    /**
     * @desc    一个主题可以有多条评论
     * @return HasMany
     * @author  skarner <2022-03-30 14:19>
     */
    public function comments():HasMany
    {
        return $this->hasMany(CommentModel::class, 'topic_id', 'id');
    }
}
