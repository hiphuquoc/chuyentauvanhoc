<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_info', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id');         // [ref: > pages.id]
            $table->text('name');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('outstanding')->default(0);
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('post_info');
    }
}
