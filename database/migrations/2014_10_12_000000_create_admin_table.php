<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->unique();
            $table->string('avatar', 300)->default('')->comment('头像');
            $table->string('mobile', 30)->default('')->unique();
            $table->string('email', 100)->default('')->unique();
            $table->string('real_name', 60)->default('');
            $table->unsignedBigInteger('role_id')->default(0);
            $table->tinyInteger('state')->default(1)->comment('状态 1:正常 2:禁用');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
