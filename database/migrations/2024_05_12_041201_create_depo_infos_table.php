<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('depo_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_name')->nullable();
            $table->string('trade_lic')->nullable();
            $table->string('nid_front')->nullable();
            $table->string('nid_back')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depo_infos');
    }
};
