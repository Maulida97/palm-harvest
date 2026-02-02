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
        Schema::create('internal_memos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['agronomi', 'pabrik']);
            $table->string('no_item');
            $table->date('berlaku');
            $table->date('tidak_berlaku')->nullable();
            $table->date('tanggal_revisi')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_memos');
    }
};
