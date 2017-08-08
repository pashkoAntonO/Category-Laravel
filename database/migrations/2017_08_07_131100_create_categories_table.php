<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('path');
            NestedSet::columns($table);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            NestedSet::dropColumns($table);
        });
    }
}
