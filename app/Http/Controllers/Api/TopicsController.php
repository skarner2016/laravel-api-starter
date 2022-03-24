<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\TopicRequest;

class TopicsController extends Controller
{
    /**
     * @desc    topic 列表
     * @author  skarner <2022-03-24 19:51>
     */
    public function index(TopicRequest $request)
    {
        dd(__METHOD__, $request->all());
    }

    /**
     * @desc    创建 topic
     * @author  skarner <2022-03-24 17:45>
     */
    public function store(TopicRequest $request)
    {
        dd(__METHOD__, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
