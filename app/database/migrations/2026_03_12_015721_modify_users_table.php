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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 60)->after('id')->unique();
            $table->foreignId('department_id')
                    ->after('password')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->boolean('role')->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //username, department_id, role
            $table->dropForeign(['department_id']);
            $table->dropColumn(['username', 'department_id', 'role']);
        });
    }
};
