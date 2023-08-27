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
        Schema::create('post_prefecture', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('prefecture_id')->constrained('prefectures');
            $table->primary(['post_id', 'prefecture_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_prefecture');
    }
};
