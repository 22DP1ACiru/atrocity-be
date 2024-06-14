<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'userID';

    protected $fillable = [
        'username',
        'password',
        'email',
        'accountDescription',
        'profilePicture',
        'followerCount',
        'isAdmin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['profile_picture_url'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'authorID');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'authorID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'authorID');
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class, 'authorID');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'senderID');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiverID');
    }

    /**
     * Get the URL of the user's profile picture.
     *
     * @return string
     */
    public function getProfilePictureUrlAttribute()
{
    if ($this->profilePicture) {
        return url('uploads/profiles/' . $this->profilePicture);
    }

    return url('uploads/profiles/default_profile.webp');
}
}
