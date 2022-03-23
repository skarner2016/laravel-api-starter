<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'topic';

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
            $table->text('content')->comment('主题内容');
            $table->unsignedInteger('hot')->default(0)->comment('热度');
            $table->unsignedTinyInteger('is_digest')->default(0)->comment('是否精华:1是0否');
            $table->unsignedTinyInteger('audit_status')->default(0)->comment('审核状态:0待审核,10通过,20拒绝');
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
        Schema::dropIfExists('topic');
    }
};
