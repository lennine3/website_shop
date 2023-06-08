<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Seo;
use Modules\Product\Entities\Product;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function allGrandFather()
    {
        return $this->parent()->with('allGrandFather');
    }

    // public function grandFather()
    // {
    //     return $this->allGrandFather();
    // }

    public function grandFather()
    {
        return $this->parent ? $this->parent->grandFather()->push($this->parent) : collect([]);
        // $grandFather = [];

        // $parent = $this->parent;
        // while ($parent) {
        //     $grandFather[] = $parent;
        //     $parent = $parent->parent;
        // }

        // return collect(array_reverse($grandFather));
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allDescendants()
    {
        return $this->children()->with('allDescendants');
    }

    public function descendants()
    {
        return $this->allDescendants()->get();
    }
    public function findBySlugOrId($identifier)
    {
        return $this->where(function ($query) use ($identifier) {
            $query->where('slug', $identifier)
                ->orWhere('id', $identifier);
        })->firstOrFail();
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'object_id', 'id')
                    ->where('type', Seo::PRODUCT_CATE);
    }
    public function banners()
    {
        return $this->hasMany('App\Modules\Banner\Models\Banner', 'object_id', 'id')->where('type', 'CATEGORY');
    }

    public function blog()
    {
        return $this->belongsToMany('App\Modules\Blog\Models\Blog', 'App\Modules\Product\Models\BlogCategoryProduct', 'category_id', 'blog_id');
    }

    public function scopeEId($query, $value)
    {
        if (isset($value)) {
            $query->where('id', '!=', @$value);
        }
        return $query;
    }

    public function scopeParent($query, $parent)
    {
        if (isset($parent)) {
            $query->where('parent_id', @$parent);
        }
        return $query;
    }

    public function scopeShowSearch($query, $value)
    {
        if (isset($value)) {
            $query->where('showSearch', @$value);
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


    public function scopeSlug($query, $slug)
    {
        if (!empty($slug)) {
            $query->where('slug', $slug);
        }
        return $query;
    }

    public function scopeDisableSlug($query, $value)
    {
        if (!empty($value)) {
            $query->where('disableSlug', $value);
        }
        return $query;
    }

    public function scopeShowHome($query, $home)
    {
        if (!empty($home)) {
            $query->where('showHome', $home);
        }
        return $query;
    }

    public function scopeShowMenu($query, $value)
    {
        if (!empty($value)) {
            $query->where('showMenu', $value);
        }
        return $query;
    }

    public function scopeExceptIds($query, $ids)
    {
        if (!empty($ids)) {
            $query->whereNotIn('id', $ids);
        }
        return $query;
    }

    public function get_category_ids($sub_ids, &$category_ids = [])
    {
        if (!empty($sub_ids)) {
            $category_ids = array_merge($category_ids, $sub_ids);
            $childs = $this->whereIn('parent_id', $sub_ids)->get();
            if (count($childs) > 0) {
                $ids = [];
                foreach ($childs as $child) {
                    $ids[] = $child->id;
                }
                $this->get_category_ids($ids, $category_ids);
            }
        }
        return $category_ids;
    }

    public function get_category($id)
    {
        if (!empty($id)) {
            $category = $this->where('id', $id)->get()->first();
            return is_null($category) ? false : $category;
        }
        return false;
    }

    public function get_categorylikename($name, $limit)
    {
        if (!empty($name)) {
            $category = $this->where('name', 'like', '%' . $name . '%')->where('status', 'A')->limit($limit);
            return is_null($category) ? false : $category;
        }
        return false;
    }

    public function get_categories($params = [])
    {
        $categories = $this->query()
            ->parent(@$params['parent_id'])
            ->status(@$params['status'])
            ->exceptIds(@$params['except_ids'])
            ->name(@$params['name'])
            ->Slug(@$params['slug'])
            ->ShowHome(@$params['showHome'])
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc');

        $categories->with('categories');

        return !empty($params['limit']) ? $categories->paginate($params['limit']) : $categories->get();
    }

    private function findIdsInternal()
    {
        $sections = collect([]);

        foreach ($this->categories as $section) {
            if ($section->status == 'A') {
                $sections->push($section->toArray());
                $sections = $sections->merge($section->findIdsInternal());
            }
        }

        return $sections;
    }

    public function childrenIds()
    {
        $this->load('categories.categories.categories');
        return $this->findIdsInternal()->pluck('id')->toArray();
    }

    public function getAllChildren()
    {
        return Category::whereIn('id', $this->getAllChildrenInternal()->pluck('id'));
    }

    private function getAllChildrenInternal()
    {
        $sections = collect([]);

        foreach ($this->categories as $section) {
            $sections->push($section->toArray());
            $sections = $sections->merge($section->getAllChildrenInternal());
        }

        return $sections;
    }

    public function getActiveMenu()
    {
        $menuActive = $this;
        while (true) {
            if (empty($menuActive->parent)) {
                break;
            }
            $menuActive = $menuActive->parent;
        }
        return $menuActive;
    }

    public function getAllChildSlug()
    {
        return Category::whereIn('id', $this->getAllChildrenInternal()->pluck('id'))->pluck('slug');
    }
}
