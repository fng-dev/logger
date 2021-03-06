<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFngLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fng_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level', 195)->nullable();
            $table->string('domain', 195)->nullable();
            $table->string('plataform', 195)->nullable();
            $table->string('code', 195)->nullable();
            $table->string('line', 195)->nullable();
            $table->text('description')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
