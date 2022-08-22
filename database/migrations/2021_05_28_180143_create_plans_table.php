<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('fa_title');
            $table->string('en_title');
            $table->string('url')->nullable();
            $table->mediumText('description');
            $table->longText('body')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('price')->default(0);
            $table->integer('support')->default(3);
            $table->boolean('isSpecial')->default(false);
            $table->unsignedBigInteger('sale')->default(0);

            $table->boolean('isOff')->default(false);
            $table->unsignedBigInteger('offPrice')->nullable();
            $table->unsignedInteger('capacity')->default(0);
            $table->unsignedInteger('consumed')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expire_at')->nullable();

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
        Schema::dropIfExists('plans');
    }
}
