<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('image_url')->nullable();
            $table->json('steam_data')->nullable();
            $table->integer('steam_app_id')->nullable();
            $table->boolean('is_from_steam')->default(false);
        });
    }

    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['image_url', 'steam_data', 'steam_app_id', 'is_from_steam']);
        });
    }
};