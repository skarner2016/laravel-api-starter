<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $tableName = 'comments';

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
            $table->unsignedInteger('reply_user_id')->default(0)->comment('回复对象的用户ID');
            $table->unsignedInteger('pid')->default(0)->comment('回复的 comment_id');
            $table->unsignedInteger('root_pid')->default(0)->comment('回复 comment_id 的根 ID');
            $table->unsignedInteger('topic_id')->comment('回复所属的主题ID');
            $table->text('content')->comment('回复内容');
            $table->unsignedTinyInteger('is_top')->default(0)->comment('是否置顶，1是0否');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态:0正常,10删帖');
            $table->unsignedTinyInteger('is_best')->default(0)->comment('是否最佳,1是0否');
            $table->string('remark')->default('')->comment('备注');
            $table->string('ip')->comment('ip地址');
            $table->string('device')->comment('设备特征');
            $table->unsignedTinyInteger('device_type')->comment('设备类型');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE {$this->tableName} comment '回复表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (strtolower(config("app.env")) != "local") {
            exit("only local support rollback");
        }

        Schema::dropIfExists($this->tableName);
    }
};
