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
        Schema::create('trees', function (Blueprint $table) {
            $table->increments('tree_id')->primary();
            $table->string('com_Name', 50);
            $table->string('sci_Name', 50);
            $table->string('fam_Name', 50);
            $table->string('barangay', 50);
            $table->string('municipality', 50);
            $table->string('province', 50);
            $table->string('Lat', 50);
            $table->string('Lng', 50);
            $table->string('origin', 50);
            $table->string('conserve_Status', 50);
            $table->string('uses', 50);
            $table->enum('tagging_Stat', ['Alive', 'Dead'])->default('Alive')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trees');
    }
};
