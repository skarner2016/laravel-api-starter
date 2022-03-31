<?php

namespace App\Repository;


use Carbon\Carbon;
use App\Models\TopicModel;
use App\Models\CommentModel;
use App\Services\TopicService;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TopicRepository
{
    /**
     * @desc    主题列表
     * @param int $typeId
     * @param int $menuId
     * @param int $perPage
     * @param int $currentPage
     * @return LengthAwarePaginator
     * @author  skarner <2022-03-24 23:39>
     */
    public static function topicPaginate(int $typeId, int $menuId, int $perPage, int $currentPage): LengthAwarePaginator
    {
        $query = TopicModel::query()
            ->with(['user'])
            ->where('type', $typeId)
            ->where('status', TopicModel::STATUS_NORMAL)
            ->where('deleted_at', null);

        // 筛选条件：热帖（一周内，按热度排序）
        if ($menuId == TopicService::MENU_HOT) {
            $startDate = Carbon::now()->subDays(7)->toDateTimeString();
            $query->where('hot', '>', 0)
                ->where('created_at', '>=', $startDate);
        }

        // 筛选条件：精品
        if ($menuId == TopicService::MENU_DIGEST) {
            $query->where('is_digest', TopicModel::IS_DIGEST_TRUE);
        }

        // 排序
        $query->orderByDesc('is_top');

        if ($menuId == TopicService::MENU_HOT) {
            $query->orderByDesc('hot');
        }

        $query->orderByDesc('created_at');

        // return $query->paginate();
        return $query->paginate($perPage, ['*'], 'page', $currentPage);
    }
}
