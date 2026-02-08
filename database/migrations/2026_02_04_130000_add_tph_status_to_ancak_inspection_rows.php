<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ancak_inspection_rows', function (Blueprint $table) {
            $table->string('tph_status')->default('bersih')->after('tph_number');
            // tph_status: 'bersih' or 'kotor'
        });
    }

    public function down(): void
    {
        Schema::table('ancak_inspection_rows', function (Blueprint $table) {
            $table->dropColumn('tph_status');
        });
    }
};
