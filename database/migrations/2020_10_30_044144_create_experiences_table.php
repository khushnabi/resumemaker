<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('resume_id');
            $table->string('job_title');
            $table->string('employer');
            $table->timestamp("start_at");
            $table->timestamp('end_at')->nullable();
            $table->string("city");
            $table->boolean('work_here');
            $table->string('description');
            $table->timestamps();
            $table->foreign('resume_id')->references('id')->on('resumes')
                ->onDelete('CASCADE')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
}
