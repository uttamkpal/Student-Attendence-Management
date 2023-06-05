<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('roll_no')->nullable()->index();
            $table->string('registration_no', 10)->nullable();
            $table->string('session')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roll_no');
            $table->dropColumn('registration_no');
            $table->dropColumn('session');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
};
