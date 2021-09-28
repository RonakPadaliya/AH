<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_details', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->text('class_description')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('participants')->nullable();
            $table->timestamps();
            // DB::statement("ALTER TABLE class_details AUTO_INCREMENT = 1234;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_details');
    }
}
