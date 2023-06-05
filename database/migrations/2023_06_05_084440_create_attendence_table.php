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
        Schema::create('attendence', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('session')->nullable();
            $table->bigInteger('roll_no')->nullable();
            $table->foreignId('courses_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('roll_no')->references('roll_no')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_present');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendence');
    }
};
