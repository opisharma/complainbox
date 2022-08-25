<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('role_id')->unsigned()->default('2');
            $table->unsignedBigInteger('category_id');
            $table->string('sub_category_name');
            $table->string('sub_category_designation');
            $table->string('sub_category_slug');
            $table->string('sub_category_email',150)->unique();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('subcategories');
    }
}
