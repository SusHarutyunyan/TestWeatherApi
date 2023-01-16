<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('weather_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('city_id')->nullable(false);
            $table->integer('time')->nullable(false)->index();
            $table->double('temperature')->nullable(false)->default(0);

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_information');
    }
};
