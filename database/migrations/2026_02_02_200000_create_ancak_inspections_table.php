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
        Schema::create('ancak_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('qc_name');
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('block_id')->constrained()->cascadeOnDelete();
            $table->date('inspection_date');
            $table->year('planting_year')->nullable();
            $table->string('seed_type')->nullable();
            $table->unsignedInteger('sph')->nullable();
            $table->string('foreman_name')->nullable();
            $table->string('clerk_name')->nullable();
            $table->text('findings')->nullable();
            $table->text('response')->nullable();
            $table->date('target_completion')->nullable();
            $table->string('evidence_path')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ancak_inspections');
    }
};
