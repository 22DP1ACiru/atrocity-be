<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id('songID');
            $table->foreignId('projectID')->constrained('projects', 'projectID')->onDelete('cascade');
            $table->foreignId('authorID')->constrained('users', 'userID')->onDelete('cascade');
            $table->json('featuredAuthorIDList')->nullable();
            $table->string('songTitle');
            $table->string('songFile'); // Storing file paths
            $table->integer('songDurationInSeconds')->nullable(); // Consider calculating this during file upload
            $table->string('songPrimaryGenre')->nullable();
            $table->json('songSecondaryGenreList')->nullable();
            $table->string('songCoverImage')->nullable(); // Default to project's cover image if not provided
            $table->integer('trackNumber')->nullable(); // Automatically calculated
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
}

