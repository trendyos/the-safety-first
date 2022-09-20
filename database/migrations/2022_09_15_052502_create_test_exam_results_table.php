<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    {
        Schema::create('test_exam_results', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('course_id');
            $table->enum('status', ['InProcess', 'Pass','Fail'])->default('InProcess');
           
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
        Schema::dropIfExists('test_results');
    }
}
