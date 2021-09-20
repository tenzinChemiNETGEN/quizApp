<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_categories', function (Blueprint $table) {
            $table->id();
            $table->string('topic')->unique();
            $table->string('language');
            $table->string('images');
            $table->unsignedBigInteger('subjects_id');
            $table->timestamps();
            $table->foreign('subjects_id')
                ->references('id')
                ->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_categories');
    }
}
