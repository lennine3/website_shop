<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Seo;
use Modules\Blog\Entities\Blog;

class BlogCategory extends Model
{
    protected $table = "blog_category";
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'object_id', 'id')
                    ->where('type', Seo::BLOG_CATE);
    }
    public function findBySlugOrId($identifier)
    {
        return $this->where(function ($query) use ($identifier) {
            $query->where('slug', $identifier)
                ->orWhere('id', $identifier);
        })->firstOrFail();
    }

    public function parent()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function allDescendants()
    {
        return $this->children()->with('allDescendants');
    }

    public function descendants()
    {
        return $this->allDescendants()->get();
    }

    public function scopeId($query, $id)
    {
        if (!empty($id)) {
            $query->where('id', $id);
        }
        return $query;
    }

    public function scopeIds($query, $ids)
    {
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }
        return $query;
    }

    public function scopeParentId($query, $parent_id)
    {
        if (!empty($parent_id)) {
            $query->where('parent_id', $parent_id);
        }
        return $query;
    }

    public function scopeTitle($query, $categoryid)
    {
        if (!empty($id)) {
            $query->where('title', $id);
        }
        return $query;
    }

    public function scopeTitleShort($query, $title_short)
    {
        if (!empty($title_short)) {
            $query->where('title_short', $title_short);
        }
        return $query;
    }

    public function scopeDescription($query, $description)
    {
        if (!empty($description)) {
            $query->where('description', $description);
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

    public function scopeShowHome($query, $home)
    {
        if (!empty($home)) {
            $query->where('showHome', $home);
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

    public function scopeSeoTitle($query, $seo_title)
    {
        if (!empty($seo_title)) {
            $query->where('seo_title', $seo_title);
        }
        return $query;
    }

    public function scopeSeoDescription($query, $seo_description)
    {
        if (!empty($seo_description)) {
            $query->where('seo_description', $seo_description);
        }
        return $query;
    }

    public function scopeSeoLink($query, $seo_link)
    {
        if (!empty($seo_link)) {
            $query->where('seo_link', $seo_link);
        }
        return $query;
    }

    public function scopePosition($query, $position)
    {
        if (!empty($position)) {
            $query->where('position', $position);
        }
        return $query;
    }

    public function scopeParent($query, $Parent)
    {
        if (isset($Parent)) {
            $query->where('parent_id', $Parent);
        }
        return $query;
    }

    public function get_categories($params = [])
    {
        $blog_category = $this->query()
            ->id(@$params['id'])
            ->ids(@$params['ids'])
            ->title(@$params['title'])
            ->Parent(@$params['parent_id'])
            ->Position(@$params['position'])
            ->ShowHome(@$params['showHome'])
            ->status(@$params['status']);
        return !empty($params['limit']) ? $blog_category->paginate($params['limit']) : $blog_category->get();
    }

    public function get_category($id)
    {
        if (!empty($id)) {
            $category = $this->query()->id(@$id)->first();
            return is_null($category) ? false : $category;
        }
        return false;
    }

    public function get_category_slug($slug)
    {
        if (!empty($slug)) {
            $category = $this->query()->slug(@$slug)->first();
            return is_null($category) ? false : $category;
        }
        return false;
    }

    // public function edit_category($params = [])
    // {
    //     $slug = url_slug(isset($params['slug']) ? $params['slug'] : $params['title_short']);
    //     $this->parent_id = @$params['parent_id'];
    //     $this->title = $params['title'];
    //     $this->title_short = @$params['title_short'];
    //     $this->description = @$params['description'];
    //     $this->showHome = @$params['showHome'];
    //     if ($params['image'] != null) {
    //         $this->image = $params['image'];
    //     }
    //     $this->slug = @$slug;
    //     $this->status = @$params['status'];
    //     $this->position = @$params['position'];
    //     $this->seo_title = @$params['seo_title'];
    //     $this->seo_description = @$params['seo_description'];
    //     $this->seo_link = @$params['seo_link'];
    //     $this->seo_keywords = @$params['seo_keywords'];
    //     $this->type = @$params['type'];
    //     $this->save();
    //     return $this->id;
    // }

    public function delete_category($id)
    {
        if (isset($id)) {
            $this->query()->id(@$id)->delete();
            return true;
        }
        return false;
    }

    // public function save_category($params = [])
    // {
    //     $slug = url_slug(isset($params['slug']) ? $params['slug'] : $params['title_short']);
    //     $this->title = @$params['title'];
    //     $this->parent_id = $params['parent_id'] ?? 0;
    //     $this->title_short = @$params['title_short'];
    //     $this->description = @$params['description'];
    //     if (request()->hasFile('image')) {
    //         $this->image = $params['file_name'];
    //     }
    //     $this->slug = @$slug;
    //     $this->showHome = @$params['showHome'];
    //     $this->showMenu = @$params['showMenu'];
    //     $this->status = @$params['status'];
    //     $this->position = @$params['position'];
    //     $this->seo_title = @$params['seo_title'];
    //     $this->seo_description = @$params['seo_description'];
    //     $this->seo_link = @$params['seo_link'];
    //     $this->seo_keywords = @$params['seo_keywords'];
    //     $this->type = @$params['type'];
    //     $this->disableSlug = request()->has('disableSlug') ? 'A' : 'D';
    //     $this->save();
    //     return $this->id;
    // }

    private function findIdsInternal()
    {
        $sections = collect([]);

        foreach ($this->children as $section) {
            if ($section->status == 'A') {
                $sections->push($section->toArray());
                $sections = $sections->merge($section->findIdsInternal());
            }
        }

        return $sections;
    }

    public function childrenIds()
    {
        $this->load('children.children.children');
        return $this->findIdsInternal()->pluck('id')->toArray();
    }

    public function breadcrumbs()
    {
        $breadcrumbs[] = $this;
        $breadcrumb = $this->parent;
        while (true) {
            if ($breadcrumb) {
                $breadcrumbs[] = $breadcrumb;
                $breadcrumb = $breadcrumb->parent;
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs);
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
}
