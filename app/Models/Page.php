<?php

namespace App\Models;

use Carbon\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends BaseModel
{
    use Sluggable, NodeTrait;

    /**
     * Temporary path used to cache URL building.
     *
     * @var string
     */
    protected $pagePath;

    /**
     * Available status.
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_HIDDEN = 'hidden';
    const STATUS_PUBLISHED = 'published';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'status',
        'path',
        'primary_image',
        'secondary_image',
        'gallery',
        'content',
        'excerpt',
        'custom_excerpt',
        'publish_start',
        'publish_end',
        'template',
        'form_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }

    /**
     * Available Page Status.
     *
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => trans('admin.pages.status.'.self::STATUS_DRAFT),
            self::STATUS_HIDDEN => trans('admin.pages.status.'.self::STATUS_HIDDEN),
            self::STATUS_PUBLISHED => trans('admin.pages.status.'.self::STATUS_PUBLISHED),
        ];
    }

    /**
     * Get status list that allows a page to be visible.
     *
     * @return array
     */
    protected function getVisibleStatus()
    {
        return auth()->check() ? [self::STATUS_DRAFT, self::STATUS_PUBLISHED] : [self::STATUS_PUBLISHED];
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include visible pages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        $now = Carbon::now();
        $visibleStatus = $this->getVisibleStatus();

        $query->whereIn('status', $visibleStatus)->where('publish_start', '<=', $now)->where(function ($query) use ($now) {
            $query->where('publish_end', '>', $now)->orWhere('publish_end', 0);
        });

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Page's form.
     *
     * @return \App\Models\Form
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Page's form.
     *
     * @return \App\Models\Form
     */
    public function visibleForm()
    {
        return $this->belongsTo(Form::class)->visible();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS AND MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the page is visible (ignore parents visibility).
     *
     * @return bool
     */
    public function getIsVisibleAttribute()
    {
        $now = Carbon::now();
        $visibleStatus = $this->getVisibleStatus();

        return in_array($this->status, $visibleStatus) and $this->publish_start < $now and ($this->publish_end > $now or $this->publish_end == 0);
    }

    public function getExcerptOrContentAttribute()
    {
        return $this->custom_excerpt ? $this->excerpt : $this->content;
    }

    /**
     * Get the url.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url($this->path);
    }

    /**
     * Get the start date of visibility.
     *
     * @return string
     */
    public function getPublishStartAttribute($value)
    {
        return $value > 0 ? $value : null;
    }

    /**
     * Get the end date of visibility.
     *
     * @return string
     */
    public function getPublishEndAttribute($value)
    {
        return $value > 0 ? $value : null;
    }

    /*
    |--------------------------------------------------------------------------
    | UTILITY
    |--------------------------------------------------------------------------
    */

    /**
     * Check if all parents are visible.
     *
     * @return bool
     */
    public function hasVisibleParents()
    {
        $hidden = $this->ancestors()->select(['status', 'publish_start', 'publish_end'])->get()->filter(function ($parent) {
            return $parent->is_visible === false;
        });

        return $hidden->count() === 0;
    }

    /**
     * Get the full path.
     *
     * @return string
     */
    public function getFullPath()
    {
        return $this->ancestors()->pluck('slug')->push($this->slug)->implode('/');
    }
}
