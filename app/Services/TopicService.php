<?php


namespace App\Services;


use App\Repository\TopicRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TopicService
{
    const MENU_LATEST = 1; // 最新
    const MENU_HOT    = 2; // 热门（48小时内，按热度排序）
    const MENU_DIGEST = 3; // 精华

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
}
