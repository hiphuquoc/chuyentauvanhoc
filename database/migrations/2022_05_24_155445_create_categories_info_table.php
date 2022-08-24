<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_info', function (Blueprint $table) {
            $table->id();
            $table->integer('category_level')->nullable();
            $table->integer('category_parent')->nullable();
            $table->integer('page_id');                 // [ref: > pages.id]
            $table->text('name');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('category_info');
    }
}
