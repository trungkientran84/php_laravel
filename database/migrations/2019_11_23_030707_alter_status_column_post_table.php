<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusColumnPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('posts', function (Blueprint $table) {
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING', 'CLOSED'])->default('DRAFT')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT')->change();
        });
    }
}
