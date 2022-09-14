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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('avatar', 300)->default('')->comment('头像');
            $table->string('mobile', 30)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('real_name', 60)->default('');
            $table->string('gender', 10)->default('');
            $table->tinyInteger('is_auth')->default(0)->comment('是否实名认证 0:否 1:是');
            $table->string('id_no', 60)->default('')->comment('身份证号');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
