<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('google_rating')->nullable();
            $table->string('happy_customers_label')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('tiktok_link')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'google_rating',
                'happy_customers_label',
                'whatsapp_link',
                'instagram_link',
                'tiktok_link',
            ]);
        });
    }
};
