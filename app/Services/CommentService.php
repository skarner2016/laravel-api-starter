<?php

namespace App\Services;

use App\Models\CommentModel;
use App\Repository\CommentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentService
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
        return CommentRepository::paginate($topicId, $commentId, $perPage, $currentPage);
    }

    /**
     * @desc    获取 comment
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     * @author  skarner <2022-04-01 12:01>
     */
    public static function findById(int $id): Model|Collection|Builder|array|null
    {
        return CommentModel::query()->find($id);
    }

    /**
     * @desc    创建 comment
     * @param array $commentData
     * @return Builder|Model
     * @author  skarner <2022-04-01 14:04>
     */
    public static function create(array $commentData): Model|Builder
    {
        return CommentModel::query()->create($commentData);
    }

    /**
     * @desc    修改数据
     * @param int   $id
     * @param array $commentData
     * @return int
     * @author  skarner <2022-04-01 14:14>
     */
    public static function update(int $id, array $commentData)
    {
        return CommentModel::query()
            ->where('id', $id)
            ->update($commentData);
    }

    /**
     * @desc    删除(软)评论
     * @param int $id
     * @return int
     * @author  skarner <2022-04-01 14:14>
     */
    public static function delete(int $id)
    {
        $commentData = [
            'deleted_at' => time(),
        ];

        return self::update($id, $commentData);
    }
}
