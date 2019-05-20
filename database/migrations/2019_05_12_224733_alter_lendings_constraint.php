<?php

use App\Lending;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLendingsConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lendings', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['reader_id']);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('cascade');
        });
        Lending::whereNull('book_id')->delete();
        Lending::whereNull('reader_id')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lendings', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['reader_id']);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('set null');
        });
    }
}
