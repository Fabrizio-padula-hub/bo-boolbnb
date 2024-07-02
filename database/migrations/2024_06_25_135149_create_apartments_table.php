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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('number_of_rooms');
            $table->tinyInteger('number_of_beds');
            $table->tinyInteger('number_of_bathrooms');
            $table->mediumInteger('square_meters')->nullable();
            $table->string('address');
            $table->double('lat', 11, 8);
            $table->double('long', 11, 8);
            $table->text('image')->nullable();
            $table->boolean('visibility');
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
        Schema::dropIfExists('apartments');
    }
};
