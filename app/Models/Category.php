<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentScope;

class Category extends Model
{
    use EloquentScope;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getNameAttribute()
    {

        return ucfirst($this->attributes['name']);
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
