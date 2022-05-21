<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_name',
        'person_id'
    ];
    
    /**
     * Get all of the page's attach-posts.
     */
    public function posts()
    {
        return $this->morphMany(Page::class, 'postable');
    }

    /**
     * Get all of the page's followers.
     */
    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }
}
