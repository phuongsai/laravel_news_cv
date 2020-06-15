<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EloquentScope;

class Subscriber extends Model
{
    use EloquentScope;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'email',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
