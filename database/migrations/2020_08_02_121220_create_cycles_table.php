<?php

use App\Models\Parcel;
use App\Models\Vegetable;
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
            $table->foreignIdFor(Vegetable::class)->constrained();
            $table->foreignIdFor(Parcel::class)->constrained();
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
