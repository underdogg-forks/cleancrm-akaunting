<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAttachmentColumnRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('revenues', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('revenues', function (Blueprint $table) {
            $table->string('attachment')->nullable();
        });
    }
}
