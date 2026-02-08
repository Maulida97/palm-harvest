<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bap_material_photos', function (Blueprint $table) {
            $table->string('type')->default('dokumentasi')->after('bap_material_id');
            // type: 'dokumentasi' or 'surat_jalan'
        });
    }

    public function down(): void
    {
        Schema::table('bap_material_photos', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
