<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToMenusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
        });
    }
}
