<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('projectID');
            $table->foreignId('authorID')->constrained('users', 'userID')->onDelete('cascade');
            $table->string('projectTitle');
            $table->enum('projectType', ['album', 'EP', 'single', 'mixtape']);
            $table->date('releaseDate')->default(now());
            $table->string('projectPrimaryGenre')->nullable();
            $table->json('projectSecondaryGenreList')->nullable();
            $table->string('projectCoverImage')->default('default_image_path'); // Default image path
            $table->integer('trackCount')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

