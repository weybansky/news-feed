<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id');
            $table->string('category_id');

            $table->string('post_title');
            $table->string('post_url');
            $table->dateTime('created_at');

            // guid
            $table->string('post_id');
            
            $table->string('post_content')->nullable();
            // dc:creator
            $table->string('post_author');

            $table->string('post_picture')->nullable();
            
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
        Schema::dropIfExists('feeds');
    }
}
