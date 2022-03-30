<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'comments';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('topic_id')->comment('回复所属的主体');
            $table->unsignedInteger('reply_comment_id')->default(0)->comment('回复的评论,默认为0');
            $table->unsignedInteger('reply_user_id')->comment('回复对象(主体/评论)的用户ID');
            $table->unsignedInteger('root_comment_id')->default(0)->comment('回复所属的评论跟评论ID，如果回复对象为主题，则为0');
            $table->text('content')->comment('主题内容');
            $table->unsignedInteger('is_digest')->default(0)->comment('是否精选：1是0否');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态:0正常，10删帖');
            $table->string('remark')->default('')->comment('备注');
            $table->char('ip', 15)->comment('IP');
            $table->unsignedTinyInteger('device_type')->default(1)->comment('设备类型:1pc');
            $table->string('device_id')->comment('设备ID');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE {$this->tableName} comment '评论表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        check_migrate();
        Schema::dropIfExists($this->tableName);
    }
};
