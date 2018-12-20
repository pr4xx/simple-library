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
            $table->string('signature')->unique();
            $table->string('title')->nullable();
            $table->string('original_title')->nullable();
            $table->string('translated_title')->nullable();
            $table->integer('year')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');

            $table->unsignedInteger('origin_id')->nullable();
            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('set null');

            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('book_tag', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->primary(['book_id', 'tag_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tag');
        Schema::dropIfExists('books');
    }
}
