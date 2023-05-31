<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugOptimize extends Model
{
    public const TYPE_BLOG_CATE = 1;
    public const TYPE_BLOG = 2;
    public const TYPE_PRODUCT = 3;
    public const TYPE_CATE_PRODUCT = 4;

    protected $table = 'slug';
    protected $guarded = [];
    protected $filterable = [];

    public function product()
    {
        return $this->belongsTo('App\Modules\Product\Models\Product', 'object_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Modules\Product\Models\Category', 'object_id', 'id');
    }

    public function cate_blog()
    {
        return $this->belongsTo('App\Modules\Blog\Models\BlogCategory', 'object_id', 'id');
    }

    public function blog()
    {
        return $this->belongsTo('App\Modules\Product\Models\Blog', 'object_id', 'id');
    }

    public function scopeType($query, $type)
    {
        if (!empty($type)) {
            $query->where('type', $type);
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if (!empty($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        } else {
            $query->orderBy('id', 'desc');
        }
        return $query;
    }

    public function scopeSlug($query, $slug)
    {
        if (!empty($slug)) {
            return $this->where('slug', $slug);
        }
        return $query;
    }

    public function get_slugs($params = [])
    {
        $slugs = $this->query()->slug(@$params['slug']);
        return !empty($params['limit']) ? $slugs->paginate($params['limit']) : $slugs->get();
    }

    public function saveItem($params = [])
    {
        $this->slug = @$params['slug'];
        $this->object_id = @$params['object_id'];
        $this->type = @$params['type'];
        $this->save();
    }
}
