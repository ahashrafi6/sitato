<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->string('name');
            $table->string('family');
            $table->string('email')->unique();
            $table->enum('type' , ['user', 'admin'])->default('user');
            $table->string('username')->unique()->nullable();
            $table->string('phone')->unique()->nullable();

            $table->boolean('suspended')->default(false);

            $table->string('affid')->nullable();
            $table->mediumText('avatar')->nullable();
            $table->text('notifications');
            
            $table->unsignedBigInteger('wallet')->default(0);

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
}
