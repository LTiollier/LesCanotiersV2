<?php

use App\Models\Activity;
use App\Models\Cycle;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->integer('minutes');
            $table->date('date');
            $table->integer('quantity')->nullable();
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
            ;
            $table->foreignIdFor(Cycle::class)
                ->nullable()
                ->constrained()
            ;
            $table->foreignIdFor(Activity::class)
                ->nullable()
                ->constrained()
            ;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
};
