<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->enum('type', ['post', 'page']);
            $table->string('img_url', 70)->nullable();
            $table->integer('cat_id');
            $table->integer('user_id');
            $table->tinyInteger('status')->default('1');;
            $table->integer('last_modified_by')->nullable();
            $table->timestamp('featured_date');
            $table->string('slug');
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
        Schema::dropIfExists('articles');
    }
}
