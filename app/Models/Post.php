<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EloquentScope;

class Post extends Model
{
    use EloquentScope;
    use SoftDeletes;

    // register datefield for this column
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
        'title', 'slug', 'body', 'view_count', 'status', 'is_approved', 'image', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
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
