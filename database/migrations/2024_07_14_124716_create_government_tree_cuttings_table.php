<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentTreeCuttingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('government_tree_cuttings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('app_letter', 50);
            $table->enum('app_letter_compliant', ['Yes', 'No'])->nullable();
            $table->string('app_letter_remarks', 50)->nullable();
            $table->string('endorsement_Certification', 50);
            $table->enum('endorsement_Certification_compliant', ['Yes', 'No'])->nullable();
            $table->string('endorsement_Certification_remarks', 50)->nullable();
            $table->string('siteDevtPlan', 50);
            $table->enum('siteDevtPlan_compliant', ['Yes', 'No'])->nullable();
            $table->string('siteDevtPlan_remarks', 50)->nullable();
            $table->string('ECC_CNC', 50);
            $table->enum('ECC_CNC_compliant', ['Yes', 'No'])->nullable();
            $table->string('ECC_CNC_remarks', 50)->nullable();
            $table->string('FPIC', 50);
            $table->enum('FPIC_compliant', ['Yes', 'No'])->nullable();
            $table->string('FPIC_remarks', 50)->nullable();
            $table->string('consent', 50);
            $table->enum('consent_compliant', ['Yes', 'No'])->nullable();
            $table->string('consent_remarks', 50)->nullable();
            $table->string('clearance', 50);
            $table->enum('clearance_compliant', ['Yes', 'No'])->nullable();
            $table->string('clearance_remarks', 50)->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');
            $table->date('app_Date')->nullable();
            $table->string('app_Agency', 30);
            $table->string('app_Loc', 30);

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('admin_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('government_tree_cuttings');
    }
}

