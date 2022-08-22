<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('server_id')->nullable();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->string('liara_app_id')->nullable();
            $table->string('liara_database_id')->nullable();
            $table->string('region')->default('iran');
            $table->string('platform')->default('laravel');
            $table->string('status')->default('username');
            $table->integer('month')->default(1);
            $table->boolean('lastNotify')->default(false);
            $table->timestamp('support_at')->nullable();
            $table->timestamp('payment_start')->nullable();
            $table->timestamp('payment_end')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
