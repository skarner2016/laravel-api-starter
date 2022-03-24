<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'topics';

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
            $table->unsignedInteger('type')->default(0)->comment('类型：0默认');
            $table->text('content')->comment('主题内容');
            $table->unsignedInteger('hot')->default(0)->comment('热度');
            $table->unsignedTinyInteger('is_digest')->default(0)->comment('是否精华:1是0否');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态:0正常,10删帖');
            $table->string('remark')->default('')->comment('备注');
            $table->string('ip')->comment('ip地址');
            $table->string('device')->comment('设备特征');
            $table->unsignedTinyInteger('device_type')->comment('设备类型');
            $table->dateTime('deleted_at')->nullable()->comment('删除时间');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE {$this->tableName} comment '主题表'");
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
