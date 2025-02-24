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
            $table->string('employee_secure_id');
            $table->string('leave_type');
            $table->string('employee_name');
            $table->string('designation');
            $table->string('place_of_posting');
            $table->date('leave_from');
            $table->date('leave_to');
            $table->text('leave_address');
            $table->text('leave_reason');
            $table->string('status')->default('pending');
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
