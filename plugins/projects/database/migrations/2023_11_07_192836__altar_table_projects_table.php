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
        Schema::table('projects', function (Blueprint $table) {


            $table->longText('body')->nullable()->change();
            $table->longText('amenities')->nullable()->change();
            $table->boolean('use_page_builder')->default(false)->change();
            $table->string('cta')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
