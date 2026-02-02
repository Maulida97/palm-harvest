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
        Schema::create('ancak_inspection_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ancak_inspection_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('row_number')->default(1);
            $table->string('harvester_name')->nullable();
            $table->string('ancak_location')->nullable();
            $table->unsignedInteger('bunch_count')->default(0);
            $table->unsignedInteger('bt_pkk')->default(0);
            $table->string('tph_number')->nullable();
            $table->enum('apd_status', ['lengkap', 'tidak'])->default('lengkap');
            $table->unsignedInteger('fine_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ancak_inspection_rows');
    }
};
