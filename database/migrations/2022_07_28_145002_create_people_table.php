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
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->text('person_A')->nullable();
            $table->text('person_B')->nullable();
            $table->text('statement')->nullable();
            $table->text('link_statement')->nullable();
            $table->date('date')->nullable();
            $table->text('status')->nullable();
            //$table->text('public_status')->nullable()->default('enable');
            $table->enum('public_status', ['enable', 'disable'])->default('enable');
            $table->text('count_person')->nullable();
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
        Schema::dropIfExists('people');
    }
};
