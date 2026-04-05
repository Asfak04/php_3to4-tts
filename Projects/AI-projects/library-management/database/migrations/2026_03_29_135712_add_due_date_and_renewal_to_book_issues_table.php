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
        Schema::table('book_issues', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('issue_date');
            $table->enum('renewal_status', ['none', 'requested', 'approved', 'declined'])->default('none')->after('due_date');
            $table->integer('renewal_count')->default(0)->after('renewal_status');
            $table->timestamp('last_returned_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_issues', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'renewal_status', 'renewal_count', 'last_returned_at']);
        });
    }
};
