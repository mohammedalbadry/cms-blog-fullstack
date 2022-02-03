<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            
            $table->string('image')->default('default.png');
            $table->text('body');
            $table->string('excerpt');

            
            $table->enum('publish', ['publish', 'waiting'])->default('publish');
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->enum('comments', ['allow', 'notallow'])->default('allow');

            $table->unsignedInteger('admin_id')->nullable();

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
        Schema::dropIfExists('pages');
    }
}
