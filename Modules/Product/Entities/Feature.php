<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'features';

    public function features()
    {
        return $this->hasMany(Feature::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Feature::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Feature::class, 'parent_id');
    }

    public function allDescendants()
    {
        return $this->children()->with('allDescendants');
    }

    public function descendants()
    {
        return $this->allDescendants()->get();
    }

    public function category()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Category', 'category_features');
    }

    public function scopeParent($query, $parent)
    {
        if (isset($parent)) {
            $query->where('parent_id', $parent);
        }

        return $query;
    }

    public function scopeCategory($query, $category)
    {
        if (!empty($category)) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category_id', $category);
            });
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query;
    }

    public function scopeName($query, $name)
    {
        if (!empty($name)) {
            $query->where('name', 'like', $name);
        }
        return $query;
    }

    public function scopeId($query, $id)
    {
        if (!empty($id)) {
            $query->where('id', $id);
        }
        return $query;
    }

    public function scopeIdArray($query, $idArray)
    {
        if (!empty($idArray)) {
            $query->whereIn('id', $idArray);
        }
        return $query;
    }

    public function scopeCategoryArrIds($query, $category_ids)
    {
        if (!empty($category_ids)) {
            $i = 0;
            foreach ($category_ids as $value) {
                if ($value != null) {
                    $i++;
                }
            }
            if ($i == 0) {
                return $query;
            }
            $query->whereHas('category', function ($q) use ($category_ids) {
                $q->whereIn('id', $category_ids);
            });
        }
        return $query;
    }

    public function scopeDiffentParent($query, $parent)
    {
        $query->where('parent_id', '<>', $parent);
        return $query;
    }

    public function get_feature($id)
    {
        if (!empty($id)) {
            $feature = $this->where('id', $id)->get()->first();
            return is_null($feature) ? false : $feature;
        }
        return false;
    }

    public function scopeSlug($query, $slug)
    {
        if (!empty($slug)) {
            $query->whereIn('slug', $slug);
        }
        return $query;
    }

    public function get_features($params = [])
    {
        $features = $this->query()
            ->Id(@$params['id'])
            ->IdArray(@$params['IdArray'])
            ->status(@$params['status'])
            ->name(@$params['name'])
            ->Category(@$params['category'])
            ->DiffentParent(@$params['dparent'])
            ->Parent(@$params['parent_id'])
            ->CategoryArrIds(@$params['categoryarr_ids'])
            ->Slug(@$params['slug'])
            ->orderBy('parent_id', 'asc');

        $features->with('features');
        return !empty($params['limit']) ? $features->skip($params['offset'])->take($params['limit'])->get() : $features->get();
    }
}
