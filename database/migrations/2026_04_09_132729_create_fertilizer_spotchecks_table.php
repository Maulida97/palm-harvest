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
        Schema::create('fertilizer_spotchecks', function (Blueprint $table) {
            $table->id();
            $table->string('qc_name');
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('block_id')->constrained()->cascadeOnDelete();
            $table->date('inspection_date');
            $table->foreignId('fertilizer_id')->constrained()->cascadeOnDelete();
            $table->string('worker_name')->nullable();
            $table->decimal('unapplied_kg', 10, 2)->default(0);
            $table->decimal('penalty_amount', 12, 2)->default(0);
            $table->text('findings')->nullable();
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
        Schema::dropIfExists('fertilizer_spotchecks');
    }
};
