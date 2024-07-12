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
            $table->id();
            $table->string('com_Name', 50);
            $table->string('sci_Name', 50);
            $table->string('fam_Name', 50);
            $table->string('address', 50);
            $table->string('Lat', 50);
            $table->string('Lng', 50);
            $table->string('origin', 50);
            $table->string('conserve_Status', 50);
            $table->string('uses', 50);
            $table->unsignedBigInteger('tagger');
            $table->string('tree_pic');
            $table->enum('tagging_Stat', ['Alive', 'Dead'])->default('Alive')->nullable(false);
            $table->enum('Tree_Status', ['1', '2'])->default('1')->nullable(false);
            $table->foreign('tagger')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
