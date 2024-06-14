<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'messageID';

    protected $fillable = [
        'senderID',
        'receiverID',
        'message',
        'isRead',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderID');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiverID');
    }
}
