<?php

use Kalnoy\Nestedset\Nestedset;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('status', 20);
            $table->string('path')->unique()->nullable();
            $table->string('primary_image')->nullable();
            $table->string('secondary_image')->nullable();
            $table->text('gallery')->nullable();
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->boolean('custom_excerpt');
            $table->string('template')->nullable();
            $table->integer('form_id')->unsigned()->nullable();
            $table->timestamp('publish_start')->nullable();
            $table->timestamp('publish_end')->nullable();
            $table->timestamps();

            NestedSet::columns($table);
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->boolean('enabled');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('menus_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->index();
            $table->string('type', 20);
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->integer('page_id')->unsigned()->nullable()->index();
            $table->integer('sublevels')->unsigned()->nullable();
            $table->integer('order_column')->unsigned();
            $table->timestamp('visible_from')->nullable();
            $table->timestamp('visible_to')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->boolean('enabled');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('forms_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('type');
            $table->string('name');
            $table->string('label');
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->text('options')->nullable();
            $table->text('rules')->nullable();
            $table->integer('order_column')->unsigned();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forms_fields');
        Schema::drop('forms');
        Schema::drop('menus_items');
        Schema::drop('menus');
        Schema::drop('pages');
    }
}
