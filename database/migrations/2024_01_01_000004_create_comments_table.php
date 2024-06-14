<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('commentID');
            $table->foreignId('authorID')->constrained('users', 'userID')->onDelete('cascade');
            $table->foreignId('projectID')->nullable()->constrained('projects', 'projectID')->onDelete('cascade');
            $table->foreignId('songID')->nullable()->constrained('songs', 'songID')->onDelete('cascade');
            $table->string('content');
            $table->timestamp('postDateTime')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

