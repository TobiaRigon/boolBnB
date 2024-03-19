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
            $table->text('description');
            $table->tinyInteger('max_guests');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('baths');
            $table->string('main_img');
            $table->string('address');
            $table->boolean('in_evidence')->default(false);
            $table->decimal('longitude', 10, 8)->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
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
