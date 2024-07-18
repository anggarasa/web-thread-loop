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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User yang melakukan aktivitas
            $table->unsignedBigInteger('target_user_id')->nullable(); // User yang menjadi target aktivitas (untuk follow/unfollow)
            $table->unsignedBigInteger('post_id')->nullable(); // Postingan terkait (untuk like dan komentar)
            $table->string('type'); // Jenis aktivitas: follow, unfollow, upload_post, like, comment
            $table->text('content')->nullable(); // Konten tambahan seperti komentar
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('postings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
