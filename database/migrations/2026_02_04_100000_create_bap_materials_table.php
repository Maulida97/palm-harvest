<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bap_materials', function (Blueprint $table) {
            $table->id();
            $table->string('qc_name');
            $table->string('jenis_material');
            $table->decimal('panjang', 10, 2)->nullable();
            $table->decimal('lebar', 10, 2)->nullable();
            $table->decimal('tinggi', 10, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->date('inspection_date');
            $table->timestamps();
        });

        Schema::create('bap_material_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bap_material_id')->constrained()->onDelete('cascade');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bap_material_photos');
        Schema::dropIfExists('bap_materials');
    }
};
