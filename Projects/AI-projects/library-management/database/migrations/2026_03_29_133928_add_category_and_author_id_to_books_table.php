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
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null')->after('id');
            $table->foreignId('author_id')->nullable()->constrained()->onDelete('set null')->after('category_id');
            $table->dropColumn('author');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
