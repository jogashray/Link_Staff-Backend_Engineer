<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Person extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "persons";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    /**
     * Get all of the person's attach-posts.
     */
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }
    /**
     * Get all of the person's attach-posts.
     */
    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }
}
