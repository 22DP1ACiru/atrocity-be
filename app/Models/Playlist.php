<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'playlistID';

    protected $fillable = [
        'authorID',
        'playlistDescription',
        'playlistCoverImage',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorID');
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song', 'playlist_id', 'song_id');
    }
}

