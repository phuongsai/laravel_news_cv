<?php

namespace App\Traits;

trait EloquentScope
{
    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        // Normalize the title which is the value
        $slug = str_slug($value);
        // check the new slug is exist or not
        if (static::whereSlug($slug)->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }

    /**
     * Increment slug.
     *
     * @param string $slug
     *
     * @return string
     */
    protected function incrementSlug($slug)
    {
        $latestSlug = $this->getLatestSlug($slug);
        // check the last character of the slug is number or not
        if (is_numeric($latestSlug[-1])) {
            // increment the value found with 1 and return the result
            return preg_replace_callback('/(\d+)$/', function ($mathces) {
                return $mathces[1] + 1;
            }, $latestSlug);
        }

        // latest slug is the first one
        // then this is the second one
        // "{$slug}-2"
        return $slug . '-2';
    }

    protected function getLatestSlug($slug)
    {
        /*
         * get the slug of the latest created post
         * @return string
         */
        return static::select('slug')->where('slug', 'like', $slug . '%')->latest()->take(1)->value('slug');
    }

    /**
     * Eloquent Query Scopes
     * For example approved($value).
     *
     * @param mixed $query
     * @param boolean $value
     */
    public function scopeApproved($query, $value = true)
    {
        return $query->where('is_approved', $value); // boolean
    }

    /**
     * Eloquent Query Scopes get X days before
     * For example lastDays($number).
     *
     * @param mixed $query
     * @param mixed $number
     */
    public function scopeLastDays($query, $number)
    {
        $dates = \Carbon\Carbon::today()->subDays($number);

        return $query->where('created_at', '>=', $dates);
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id', 2)->withTrashed();
    }

    public function getCreatedAtAttribute()
    {
        if ($this->attributes['created_at'] == null) {
            return 'N/A';
        }

        return $this->attributes['created_at'];
    }

    public function getUpdatedAtAttribute()
    {
        if ($this->attributes['updated_at'] == null) {
            return 'N/A';
        }

        return $this->attributes['updated_at'];
    }

    /**
     * Eloquent Query Scopes
     *  published().
     *
     * @param mixed $query
     */
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('deleted_at', null);
    }
}
