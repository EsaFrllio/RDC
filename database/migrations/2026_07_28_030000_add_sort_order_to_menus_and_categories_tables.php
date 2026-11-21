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
        if (Schema::hasTable('menu_categories') && !Schema::hasColumn('menu_categories', 'sort_order')) {
            Schema::table('menu_categories', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('slug');
            });
        }

        if (Schema::hasTable('menus') && !Schema::hasColumn('menus', 'sort_order')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('is_available');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('menu_categories') && Schema::hasColumn('menu_categories', 'sort_order')) {
            Schema::table('menu_categories', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasTable('menus') && Schema::hasColumn('menus', 'sort_order')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};
