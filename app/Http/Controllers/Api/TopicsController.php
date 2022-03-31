<?php

namespace App\Http\Controllers\Api;

use App\Lib\App;
use App\Lib\Api;
use App\Lib\Code;
use App\Services\TopicService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;
use App\Http\Requests\Api\TopicRequest;

class TopicsController extends Controller
{
    /**
     * @desc    topic 列表
     * @author  skarner <2022-03-24 19:51>
     */
    public function index(TopicRequest $request)
    {
        $typeId      = $request->input('type_id', 1);
        $menuId      = $request->input('menu_id', TopicService::MENU_LATEST);
        $perPage     = $request->input('per_page', App::PER_PAGE);
        $currentPage = $request->input('current_page', App::CURRENT_PAGE);

        $paginate = TopicService::topicPaginate($typeId, $menuId, $perPage, $currentPage);

        return Api::success(TopicResource::collection($paginate));
    }

    /**
     * @desc    创建 topic
     * @author  skarner <2022-03-24 17:45>
     */
    public function store(TopicRequest $request)
    {
        // TODO:
        $userId = 1;

        $content = $request->input('content');
        $typeId  = $request->input('type_id', 1);
        $ip      = $request->ip();

        $topicData = [
            'user_id' => $userId,
            'type'    => $typeId,
            'content' => $content,
            'ip'      => $ip,
        ];

        if (!TopicService::create($topicData)) {
            return Api::fail();
        }

        return Api::success();
    }

    /**
     * @desc    主题详情
     * @author  skarner <2022-03-24 22:51>
     */
    public function show($id)
    {
        if (!$topic = TopicService::findById($id)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        return Api::success(new TopicResource($topic));
    }

    /**
     * @desc    修改主题
     * @author  panjunda@heyuedi.net <2022-03-24 22:51>
     */
    public function update(TopicRequest $request, $id)
    {
        $content = $request->input('content');

        if (!TopicService::findById($id)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        $updateTopicData = [
            'content' => $content,
        ];
        TopicService::update($id, $updateTopicData);

        return Api::success();
    }

    /**
     * @desc    删除主题
     * @author  panjunda@heyuedi.net <2022-03-24 22:52>
     */
    public function destroy($id)
    {
        if (!TopicService::findById($id)) {
            return Api::fail(Code::PARAM_ERROR);
        }

        TopicService::delete($id);

        return Api::success();
    }
}
