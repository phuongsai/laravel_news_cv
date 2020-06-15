<?php

namespace App\Models;

use App\Traits\EloquentScope;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use EloquentScope;

    protected $fillable = [
        'name', 'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
