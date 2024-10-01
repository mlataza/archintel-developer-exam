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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('image', 255);
            $table->string('link', 255);
            $table->longText('content');
            $table->string('status', 32);

            $table->foreignId('writer_id')->constrained(
                table: 'users', indexName: 'articles_writer_id'
            )->onDelete('CASCADE');

            $table->foreignId('editor_id')->nullable()->constrained(
                table: 'users', indexName: 'articles_editor_id'
            )->onDelete('CASCADE');

            $table->foreignId('company_id')->constrained()->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
