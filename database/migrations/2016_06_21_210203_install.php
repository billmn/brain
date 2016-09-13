<?php

use Kalnoy\Nestedset\Nestedset;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Install extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

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
            $table->boolean('custom_excerpt')->default(false);
            $table->string('template')->nullable();
            $table->integer('form_id')->unsigned()->nullable();
            $table->timestamp('publish_start')->useCurrent();
            $table->timestamp('publish_end')->nullable();
            $table->timestamps();

            NestedSet::columns($table);
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled');
            $table->string('name')->unique();
            $table->string('title')->nullable();
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
            $table->foreign('page_id')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->boolean('enabled');
            $table->string('name')->unique();
            $table->string('title')->nullable();
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
        Schema::drop('settings');
        Schema::drop('password_resets');
        Schema::drop('users');
        Schema::drop('forms_fields');
        Schema::drop('forms');
        Schema::drop('menus_items');
        Schema::drop('menus');
        Schema::drop('pages');
    }
}
