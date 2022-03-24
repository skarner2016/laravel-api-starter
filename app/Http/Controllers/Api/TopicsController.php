<?php

namespace App\Http\Controllers\Api;

use App\Lib\App;
use Illuminate\Http\Request;
use App\Services\TopicService;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    /**
     * @desc    topic 列表
     * @author  skarner <2022-03-24 19:51>
     */
    public function index(Request $request)
    {
        $typeId      = $request->input('type_id', 1);
        $menuId      = $request->input('menu_id', TopicService::MENU_LATEST);
        $perPage     = $request->input('per_page', App::PER_PAGE);
        $currentPage = $request->input('current_page', App::CURRENT_PAGE);


        $paginate = TopicService::topicPaginate($typeId, $menuId, $perPage, $currentPage);


        dd(__METHOD__, $request->all());
    }

    /**
     * @desc    创建 topic
     * @author  skarner <2022-03-24 17:45>
     */
    public function store(Request $request)
    {
        dd(__METHOD__, $request->all());
    }

    /**
     * @desc
     * @author  skarner <2022-03-24 22:51>
     */
    public function show($id)
    {
        //
    }

    /**
     * @desc
     * @author  panjunda@heyuedi.net <2022-03-24 22:51>
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @desc
     * @author  panjunda@heyuedi.net <2022-03-24 22:52>
     */
    public function destroy($id)
    {
        //
    }
}
