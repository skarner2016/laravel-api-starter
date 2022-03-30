<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends BaseModel
{
    protected $table = 'users';

    const STATUS_DEFAULT = 0; // 状态:默认
    const STATUS_DISABLE = 1; // 状态:禁用账户

    /**
     * @desc    工厂实例
     * @return UserFactory|Factory
     * @author  skarner <2022-03-30 11:31>
     */
    protected static function newFactory(): Factory|UserFactory
    {
        return UserFactory::new();
    }

    /**
     * @desc    用户可以发表了多个主题
     * @return HasMany
     * @author  skarner <2022-03-30 11:47>
     */
    public function topics(): HasMany
    {
        return $this->hasMany(TopicModel::class, 'user_id', 'id');
    }
}
