<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->id();
            $table->string('fa_title');
            $table->string('en_title');
            $table->string('region')->default('iran');
            $table->string('server_id');
            $table->string('database_id');
            $table->unsignedBigInteger('price')->default(0);
            $table->boolean('isSpecial')->default(false);
            $table->mediumText('server')->nullable();
            $table->mediumText('database')->nullable();
            $table->string('sum')->nullable();
            

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
        Schema::dropIfExists('servers');
    }
}
