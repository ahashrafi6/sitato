<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('code');
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('capacity')->nullable();
            $table->unsignedInteger('capacity_per_user')->nullable();
            $table->unsignedInteger('consumed')->nullable();
            $table->mediumText('products')->nullable();
            $table->mediumText('users')->nullable();
            $table->string('type')->default('cash');
            $table->timestamp('start_at');
            $table->timestamp('expire_at');
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
        Schema::dropIfExists('discounts');
    }
}
