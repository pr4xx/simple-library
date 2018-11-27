<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('original_title');

            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');

            $table->unsignedInteger('origin_id')->nullable();
            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('set null');

            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

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
        Schema::dropIfExists('books');
    }
}
