<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Seo;
use function App\Libraries\StripSlug;
use App\Models\User;
class Blog extends Model
{
    protected $table = 'blog';
    protected $guarded = [];

    public function categoryblogproduct()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Category', 'App\Modules\Product\Models\BlogCategoryProduct', 'blog_id', 'category_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Modules\Blog\Models\BlogCategory', 'blog_category_id', 'id');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'object_id', 'id')
                    ->where('type', Seo::BLOG);
    }
    public function findBySlugOrId($identifier)
    {
        return $this->where(function ($query) use ($identifier) {
            $query->where('slug', $identifier)
                ->orWhere('id', $identifier);
        })->firstOrFail();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Modules\Blog\Models\BlogComment', 'blog_id', 'id');
    }

    public function scopeId($query, $id)
    {
        if (!empty($id)) {
            $query->where('id', $id);
        }
        return $query;
    }

    public function scopeEId($query, $id)
    {
        if (!empty($id)) {
            $query->where('id', '!=', $id);
        }
        return $query;
    }

    public function scopeUserId($query, $user_id)
    {
        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }
        return $query;
    }

    public function scopePositionCategory($query, $position)
    {
        if (!empty($position)) {
            return $query->whereHas('category', function ($q) use ($position) {
                $q->where('position', $position);
            });
        }
    }

    public function scopeBlogCategoryId($query, $blog_category_id)
    {
        if (!empty($blog_category_id)) {
            $blog_category = BlogCategory::find($blog_category_id);
            $children_ids = $blog_category->childrenIds() ?: [$blog_category->id];
            $query->whereIn('blog_category_id', $children_ids);
        }
        return $query;
    }

    public function scopeBlogCategoryIdArr($query, $blog_category_idArr)
    {
        if (!empty($blog_category_idArr)) {
            $query->whereIn('blog_category_id', $blog_category_idArr);
        }
        return $query;
    }

    public function scopeTitleShort($query, $title_short)
    {
        if (!empty($title_short)) {
            $query->where('title_short', 'like', '%' . $title_short . '%');
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

    public function get_blog_id($id)
    {
        if (!empty($id)) {
            $blog = $this->query()->id(@$id)->first();
            return is_null($blog) ? false : $blog;
        }
        return false;
    }

    public function get_blog_slug($slug)
    {
        if (!empty($slug)) {
            $blog = $this->query()->slug(@$slug)->first();
            return is_null($blog) ? false : $blog;
        }
        return false;
    }

    public function scopeTitle($query, $title)
    {
        if (!empty($title)) {
            $query->where('title', 'like', '%' . $title . '%');
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

    public function scopeShowhome($query, $showhome)
    {
        if (!empty($showhome)) {
            $query->where('showhome', $showhome);
        }
        return $query;
    }

    public function get_blogs($params = [])
    {
        $blogs = $this->query()
            ->id(@$params['id'])
            ->Slug(@$params['slug'])
            ->Title(@$params['title'])
            ->BlogCategoryId(@$params['blog_category_id'])
            ->BlogCategoryIdArr(@$params['blog_category_idArr'])
            ->status(@$params['status'])
            ->PositionCategory(@$params['position'])
            ->Order(@$params['order'])
            ->showhome(@$params['showhome']);
        return !empty($params['limit']) ? $blogs->paginate($params['limit']) : $blogs->get();
    }

    public function get_blogs_related($limit, $cate_id, $except_ids)
    {
        $blogs = $this->where('status', 'A')
            ->where('id','!=', $except_ids)
            ->where('blog_category_id', $cate_id)
            ->inRandomOrder()->limit($limit)->get();
        return $blogs;
    }

    public function filter_blogs($params = [])
    {
        $filterBlogs = $this->query()
            ->id(@$params['id'])
            ->titleShort(@$params['title_short'])
            ->blogCategoryId(@$params['blog_category_id'])
            ->status(@$params['status'])
            ->Order(@$params['order']);
        return !empty($params['limit']) ? $filterBlogs->paginate($params['limit']) : $filterBlogs->get();
    }

    public function random_blogs_ref($params = [])
    {
        $filterBlogs = $this->query()
            ->blogCategoryId(@$params['blog_category_id'])
            ->status(@$params['status']);
        return $filterBlogs->where('id', '!=', @$params['id'])->inRandomOrder()->limit(@$params['limit'])->get();
    }

    public function delete_category($id)
    {
        if (isset($id)) {
            $this->query()->id(@$id)->delete();
            return true;
        }
        return false;
    }

    public function save_blog($params = [])
    {
        $slug = StripSlug(isset($params['slug']) ? $params['slug'] : $params['title_short']);
        $this->user_id = @$params['user_id'];
        $this->blog_category_id = @$params['blog_category_id'];
        $this->title = @$params['title'];
        $this->title_short = @$params['title_short'];
        $this->slug = @$slug;
        $this->description = @$params['description'];
        if (request()->hasFile('image')) {
            $this->image = @$params['file_name'];
            $this->webp_path = webpFormat(@$params['file_name']);
        }
        $this->content = @$params['content'];
        $this->status = @$params['status'];
        $this->seo_title = @$params['seo_title'];
        $this->seo_description = @$params['seo_description'];
        $this->seo_link = @$params['seo_link'];
        $this->seo_keywords = @$params['seo_keywords'];
        $this->alternative_link = @$params['alternative_link'];
        $this->position_show = @$params['position_show'];
        $this->showhome = @$params['showhome'];
        $this->toc = @$params['toc'];
        $this->amp_content = $params['amp_content'];
        $this->optimize_content = $params['optimize_content'];
        $this->save();
        return true;
    }

    public function isFooterBlog()
    {
        return (bool) Blog::positionCategory("FOOTER")->id($this->id)->first();
    }
}
