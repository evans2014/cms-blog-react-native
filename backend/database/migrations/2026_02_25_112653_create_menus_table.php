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

        if (!Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->id();
                $table->string('title');          // заглавие на менюто
                $table->string('type')->default('custom');          // 'page', 'post_overview', 'custom'
                $table->string('url')->nullable();  // за custom link
                $table->foreignId('page_id')->nullable()->constrained('pages')->onDelete('cascade');
                $table->foreignId('post_overview_id')->nullable()->constrained('posts')->onDelete('cascade');
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
