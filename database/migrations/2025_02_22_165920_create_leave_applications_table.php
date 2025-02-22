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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('secure_id', 32)->unique();
            $table->string('employee_secure_id', 32)->unique();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_type_secure_id');
            $table->unsignedBigInteger('leave_type_id');
            
            $table->string('employee_name');
            $table->string('designation');
            $table->string('place_of_posting');
             $table->foreignId('leave_type');
            $table->date('leave_from');
            $table->date('leave_to');
            $table->text('leave_address');
            $table->text('leave_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
