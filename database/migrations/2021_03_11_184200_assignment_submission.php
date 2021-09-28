<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignmentSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_code')->unsigned()->index();
            $table->foreign('class_code')->references('id')->on('class_details')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('assignment_id')->unsigned()->index();
            $table->foreign('assignment_id')->references('id')->on('assignment_details')->onDelete('cascade');
            $table->string('assignment_file');
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
        Schema::dropIfExists('assignment_submission');
    }
}
