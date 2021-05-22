<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Filesystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filesystem', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('sha_value');
            $table->timestamps();
        });
        Schema::create('userfiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fileid');
            $table->unsignedBigInteger('userid');
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
        Schema::dropIfExists('filesystem');
        Schema::dropIfExists('userfiles');
    }
}
