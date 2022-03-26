<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->date('starts_at');
            $table->date('ends_at')->nullable();

            $table->unsignedBigInteger('vegetable_id')->nullable();
            $table->foreign('vegetable_id')->references('id')->on('vegetables');
            $table->unsignedBigInteger('parcel_id')->nullable();
            $table->foreign('parcel_id')->references('id')->on('parcels');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cycles');
    }
};
