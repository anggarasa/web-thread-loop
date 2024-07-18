<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('postings', function (Blueprint $table) {
        $table->unsignedInteger('likes_count')->default(0);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('postings', function (Blueprint $table) {
            $table->dropColumn('likes_count');
        });
    }
};