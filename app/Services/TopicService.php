<?php


namespace App\Services;


use App\Models\TopicModel;
use App\Repository\TopicRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TopicService
{
    const MENU_LATEST = 1; // 最新
    const MENU_HOT    = 2; // 热门（48小时内，按热度排序）
    const MENU_DIGEST = 3; // 精华

    const MENU_LIST = [
        self::MENU_LATEST,
        self::MENU_HOT,
        self::MENU_DIGEST,
    ];

    /**
     * @desc    主题列表
     * @param int $typeId
     * @param int $menuId
     * @param int $perPage
     * @param int $currentPage
     * @return LengthAwarePaginator
     * @author  skarner <2022-03-24 23:40>
     */
    public static function topicPaginate(int $typeId, int $menuId, int $perPage, int $currentPage): LengthAwarePaginator
    {
        return TopicRepository::topicPaginate($typeId, $menuId, $perPage, $currentPage);
    }

    /**
     * @desc    创建主题
     * @param array $topicData
     * @return Builder|Model
     * @author  skarner <2022-03-31 18:01>
     */
    public static function create(array $topicData): Model|Builder
    {
        return TopicModel::query()->create($topicData);
    }

    /**
     * @desc    主题详情
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     * @author  skarner <2022-03-31 18:04>
     */
    public static function findById(int $id): Model|Collection|Builder|array|null
    {
        return TopicModel::query()->find($id);
    }

    /**
     * @desc    修改主题
     * @param int   $id
     * @param array $updateTopicData
     * @return int
     * @author  skarner <2022-03-31 18:17>
     */
    public static function update(int $id, array $updateTopicData): int
    {
        return TopicModel::query()
            ->where('id', $id)
            ->update($updateTopicData);
    }

    /**
     * @desc    删除（软）主题
     * @param int $id
     * @return int
     * @author  skarner <2022-03-31 18:22>
     */
    public static function delete(int $id): int
    {
        $updateTopicData = [
            'deleted_at' => now(),
        ];

        return self::update($id, $updateTopicData);
    }
}
