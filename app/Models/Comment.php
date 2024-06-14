<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'commentID';

    protected $fillable = [
        'authorID',
        'projectID',
        'songID',
        'content',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorID');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID');
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'songID');
    }
}
