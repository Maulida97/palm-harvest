<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fine_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('code'); // Nomor pelanggaran
            $table->string('description'); // Bentuk pelanggaran
            $table->integer('fine_pemanen_old')->default(0); // Denda lama pemanen
            $table->integer('fine_pemanen_new')->default(0); // Denda baru pemanen
            $table->integer('fine_kerani_panen')->default(0);
            $table->integer('fine_mandor_panen')->default(0);
            $table->integer('fine_mandor_1')->default(0);
            $table->integer('fine_asisten')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add fine details columns to ancak_inspection_rows
        Schema::table('ancak_inspection_rows', function (Blueprint $table) {
            $table->foreignId('fine_category_id')->nullable()->after('fine_amount');
            $table->integer('fine_count')->default(0)->after('fine_category_id'); // Jumlah temuan
            $table->integer('fine_pemanen')->default(0)->after('fine_count');
            $table->integer('fine_kerani_panen')->default(0)->after('fine_pemanen');
            $table->integer('fine_mandor_panen')->default(0)->after('fine_kerani_panen');
            $table->integer('fine_mandor_1')->default(0)->after('fine_mandor_panen');
            $table->integer('fine_asisten')->default(0)->after('fine_mandor_1');
        });
    }

    public function down(): void
    {
        Schema::table('ancak_inspection_rows', function (Blueprint $table) {
            $table->dropColumn([
                'fine_category_id', 
                'fine_count', 
                'fine_pemanen', 
                'fine_kerani_panen', 
                'fine_mandor_panen', 
                'fine_mandor_1', 
                'fine_asisten'
            ]);
        });

        Schema::dropIfExists('fine_categories');
    }
};
