<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $primaryKey = 'songID';

    protected $fillable = [
        'projectID',
        'authorID',
        'featuredAuthorIDList',
        'songTitle',
        'songFile',
        'songDurationInSeconds',
        'songPrimaryGenre',
        'songSecondaryGenreList',
        'songCoverImage',
        'trackNumber',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'authorID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'songID');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_song', 'song_id', 'playlist_id');
    }
}
