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
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('leave_type');
            $table->integer('total_leaves')->default(0);
            $table->integer('used_leaves')->default(0);
            $table->integer('remaining_leaves')->default(0);
            $table->date('start_date')->nullable(); 
            $table->date('end_date')->nullable(); 
            $table->integer('year')->default(date('Y'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
