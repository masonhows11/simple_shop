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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('priority')->comment('0 : low , 1 : mid : 2 : high');
            $table->tinyInteger('status')->default(0)->comment('0 : created , 1 : replied : 2 : closed');
            $table->string('file_path')->nullable();
            $table->tinyInteger('department')->comment('0 : support , 1 : tech : 2 : financial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
