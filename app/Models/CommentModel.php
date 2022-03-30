<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentModel extends BaseModel
{
    protected $table = 'comments';

    const IS_DIGEST_FALSE = 0; // 非精选评论
    const IS_DIGEST_TRUE  = 1; // 精选评论

    /**
     * @desc    工厂实例
     * @return CommentFactory|Factory
     * @author  skarner <2022-03-30 11:31>
     */
    protected static function newFactory(): Factory|CommentFactory
    {
        return CommentFactory::new();
    }
}
