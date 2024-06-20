<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id('playlistID');
            $table->foreignId('authorID')->constrained('users', 'userID')->onDelete('cascade');
            $table->string('playlistTitle')->nullable();
            $table->string('playlistDescription')->nullable();
            $table->string('playlistCoverImage')->default('http://localhost:8000/uploads/profiles/default.webp'); // stores relative file paths
            $table->timestamp('uploadDateTime')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('playlists');
    }
}

