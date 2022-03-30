<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('mobile')->unique()->comment('电话');
            $table->string('name')->unique()->comment('昵称');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态:0正常，1封禁');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE {$this->tableName} comment '用户表'");
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
