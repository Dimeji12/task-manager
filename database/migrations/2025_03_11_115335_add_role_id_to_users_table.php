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
        Schema::table('users', function (Blueprint $table) {
            // Add the role_id column as nullable initially
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Drop the foreign key constraint
            $table->dropColumn('role_id');    // Drop the role_id column
        });
    }
};
