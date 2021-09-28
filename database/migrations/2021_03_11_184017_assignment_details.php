<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignmentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_code')->unsigned()->index();
            $table->foreign('class_code')->references('id')->on('class_details')->onDelete('cascade');
            $table->string('assignment_title');
            $table->text('assignment_description')->nullable();
            $table->string('assignment_file')->nullable();
            $table->date('due_Date')->nullable();
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
        Schema::dropIfExists('assignment_details');
    }
}
