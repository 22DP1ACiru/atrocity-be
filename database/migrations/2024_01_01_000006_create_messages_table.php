<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('messageID');
            $table->foreignId('senderID')->constrained('users', 'userID')->onDelete('cascade');
            $table->foreignId('receiverID')->constrained('users', 'userID')->onDelete('cascade');
            $table->text('message');
            $table->boolean('isRead')->default(false);
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

