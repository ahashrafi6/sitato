<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('fa_title');
            $table->string('en_title');
            $table->string('slug');
            $table->mediumText('description');
            $table->longText('body')->nullable();
            $table->string('status')->default('draft');
            $table->string('platform')->default('laravel');
            $table->boolean('isSpecial')->default(false);
            $table->mediumText('icon')->nullable();
            $table->mediumText('cover')->nullable();
            $table->mediumText('video')->nullable();
            $table->mediumText('demo')->nullable();
            $table->string('version')->nullable();

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
        Schema::dropIfExists('products');
    }
}
