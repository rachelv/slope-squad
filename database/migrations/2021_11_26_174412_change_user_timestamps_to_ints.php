<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserTimestampsToInts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('users', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'created_at')) {
                $table->unsignedInteger('created_at')->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'updated_at')) {
                $table->unsignedInteger('updated_at')->nullable()->after('created_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}