<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * Get all of the owning postable models.
     */
    protected $hidden = [
        'postable_id', 'postable_type'
    ];
    public function postable()
    {
        return $this->morphTo();
    }
}
