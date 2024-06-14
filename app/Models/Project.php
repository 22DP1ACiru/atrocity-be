<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'projectID';

    protected $fillable = [
        'authorID',
        'projectTitle',
        'projectType',
        'releaseDate',
        'projectPrimaryGenre',
        'projectSecondaryGenreList',
        'projectCoverImage',
        'trackCount',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorID');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'projectID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'projectID');
    }
}

