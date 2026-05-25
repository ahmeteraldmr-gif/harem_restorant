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
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->string('name_es')->nullable()->after('name_en');
            $table->string('name_ar')->nullable()->after('name_es');
            $table->string('name_ru')->nullable()->after('name_ar');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('name_es')->nullable()->after('name_en');
            $table->string('name_ar')->nullable()->after('name_es');
            $table->string('name_ru')->nullable()->after('name_ar');
            $table->text('description_es')->nullable()->after('description_en');
            $table->text('description_ar')->nullable()->after('description_es');
            $table->text('description_ru')->nullable()->after('description_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropColumn(['name_es', 'name_ar', 'name_ru']);
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn([
                'name_es', 'name_ar', 'name_ru',
                'description_es', 'description_ar', 'description_ru'
            ]);
        });
    }
};
