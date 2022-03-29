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
            $table->unsignedTinyInteger('type')->default(1)->comment('类型:1默认');
            $table->text('content')->comment('主题内容');
            $table->unsignedInteger('hot')->default(0)->comment('热度');
            $table->unsignedInteger('is_digest')->default(0)->comment('是否精华主题：1是0否');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态:0正常，10删帖');
            $table->string('remark')->default('')->comment('备注');
            $table->char('ip', 15)->comment('IP');
            $table->unsignedTinyInteger('device_type')->default(1)->comment('设备类型:1pc');
            $table->string('device_id')->comment('设备ID');
            $table->timestamp('deleted_at')->nullable();
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
        check_migrate();
        Schema::dropIfExists($this->tableName);
    }
};
