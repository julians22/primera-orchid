<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            // 1. Hapus kolom-kolom lama yang sudah tidak dipakai
            if (Schema::hasColumn('page_settings', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('page_settings', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('page_settings', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
            if (Schema::hasColumn('page_settings', 'meta_keywords')) {
                $table->dropColumn('meta_keywords');
            }

            // 2. Lepas constraint unique pada page_key lama jika ada
            $table->dropUnique(['page_key']);

            // 3. Tambahkan kolom section_key
            $table->string('section_key')->after('page_key');

            // 4. Buat unique constraint gabungan (page_key + section_key)
            $table->unique(['page_key', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->dropUnique(['page_key', 'section_key']);
            $table->dropColumn('section_key');
            
            $table->string('title')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            $table->unique('page_key');
        });
    }
};