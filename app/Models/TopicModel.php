<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicModel extends BaseModel
{
    protected $table = 'topics';

    const IS_DIGEST_TRUE  = 1; // 是否精华：是
    const IS_DIGEST_FALSE = 0; // 是否精华：否

    /**
     * @desc    主题属于用户
     * @return BelongsTo
     * @author  skarner <2022-03-24 23:18>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id', 'user_id');
    }
}
