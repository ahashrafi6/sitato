<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('final_price');
            $table->string('resNumber')->nullable();
            $table->string('refNumber')->nullable();
            $table->string('type')->default('factor');
            $table->string('terminal')->default('zarin');
            $table->integer('status')->default(false);
            $table->integer('isSystem')->default(false);
            $table->text('items')->nullable();
            $table->text('discount')->nullable();
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('factors');
    }
}
