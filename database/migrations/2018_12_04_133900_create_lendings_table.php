<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('book_id')->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');

            $table->unsignedInteger('reader_id')->nullable();
            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('set null');

            $table->dateTime('due_at')->nullable();
            $table->dateTime('returned_at')->nullable();

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
        Schema::dropIfExists('lendings');
    }
}
