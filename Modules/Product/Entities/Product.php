<?php

namespace Modules\Product\Entities;

use App\Traits\FullTextSearch;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\ProductImage;
use App\Models\Seo;

use function App\Libraries\StripSlug;

class Product extends Model
{
    protected $table = 'products';
    // protected $primaryKey = 'product_id';
    protected $guarded = [];

    public function get_parent()
    {
        return $this->belongsTo('Modules\Product\Entities\Product', 'parent_product_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function seo()
    {
        return $this->hasOne(Seo::class, 'object_id', 'id')
                    ->where('type', Seo::PRODUCT);
    }

    public function features()
    {
        return $this->belongsToMany('Modules\Product\Entities\Feature', 'Modules\Product\Entities\ProductFeature', 'product_id', 'feature_id');
    }

    public function productfeature()
    {
        return $this->hasMany('App\Modules\Evaluate\Models\product_features', 'product_id', 'product_id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'parent_product_id', 'id');
    }

    public function Chaproduct()
    {
        return $this->hasOne('Modules\Product\Entities\Product', '', 'parent_product_id');
    }

    public function parentproductfull()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'parent_product_id', 'product_id')->with('images')->with('features');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id', 'product_id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Modules\Partner\Models\Partner', 'partner_id', 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Modules\Brand\Models\Brand', 'brand_id', 'id');
    }

    // public function categories()
    // {
    //     return $this->belongsToMany('Modules\Product\Entities\Category', 'Modules\Product\Entities\ProductCategory', 'product_id', 'category_id');
    // }

    public function featureproductparent()
    {
        return $this->hasMany('Modules\Product\Entities\ProductFeature', 'parent_product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('position', 'ASC');
    }

    public function skus()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'parent_product_id', 'product_id');
    }

    public function banners()
    {
        return $this->hasMany('App\Modules\Banner\Models\Banner', 'object_id', 'product_id');
    }

    public function scopeId($query, $product_id)
    {
        if (!empty($product_id)) {
            $query->where('product_id', $product_id);
        }
        return $query;
    }
    public function scopeName($query, $name)
    {
        if (!empty($name)) {
            $query->where(function ($subquery) use ($name) {
                $subquery->where('name', 'like', '%' . StripSlug($name) . '%');
            });
        }
        return $query;
    }
    public function scopeCategories($query, $category_ids){
        if (!empty($category_ids)) {
            $query->where('category_id', $category_ids);
        }
        return $query;
    }
    public function scopeDifferentId($query, $DifferentId)
    {
        if (!empty($DifferentId)) {
            $query->where('product_id', '<>', $DifferentId);
        }
        return $query;
    }

    public function scopeCode($query, $product_code)
    {
        if (!empty($product_code)) {
            $query->where('product_code', $product_code);
        }
        return $query;
    }

    public function scopeParent_product_id($query, $parent_product_id)
    {
        if (isset($parent_product_id)) {
            $query->where('parent_product_id', $parent_product_id);
        }
        return $query;
    }


    public function scopeprice($query, $price)
    {
        if (!empty($price)) {
            $pieces = explode("-", $price);
            $query->where(function ($q) use ($pieces) {
                $q->where('sell_price', '>', '0');
                $q->where(function ($qq) use ($pieces) {
                    $qq->where('sell_price', '>=', $pieces[0]);
                    $qq->where('sell_price', '<=', $pieces[1]);
                });
            })
                ->orwhere(function ($q) use ($pieces) {
                    $q->where('sell_price', '<=', '0');
                    $q->where(function ($qq) use ($pieces) {
                        $qq->where('org_price', '>=', $pieces[0]);
                        $qq->where('org_price', '<=', $pieces[1]);
                    });
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

    public function scopeParent($query, $parent)
    {
        if (!empty($parent)) {
            $query->where('parent_product_id', $parent[0], $parent[1]);
        }
        return $query;
    }

    public function scopeChild($query, $has_child)
    {
        if (!empty($has_child)) {
            $query->where('has_child', $has_child);
        }
        return $query;
    }

    public function scopeCollection($query, $collection)
    {
        if (!empty($collection)) {
            return $query->whereHas('collection', function ($q) use ($collection) {
                $q->where('collection_id', $collection);
            });
        }
    }

    public function scopeParentFeature($query, $ParentFeature)
    {
        if (!empty($ParentFeature)) {
            return $query->whereHas('features', function ($q) use ($ParentFeature) {
                $q->where('parent_id', $ParentFeature);
            });
        }
    }

    public function scopeBrand($query, $brand_id)
    {
        if (!empty($brand_id)) {
            $query->where('brand_id', $brand_id);
        }
        return $query;
    }

    public function scopeSellPrice($query, $sell_price)
    {
        if (!empty($sell_price)) {
            $query->where('sell_price', '>=', $sell_price[0]);
            $query->where('sell_price', '<=', $sell_price[1]);
        }
        return $query;
    }

    public function scopeQty($query, $qtys)
    {
        if (!empty($qtys)) {
            $query->where('qty', '>=', @$qtys[0]);
            $query->where('qty', '<=', @$qtys[1]);
        }
        return $query;
    }

    public function scopeSlug($query, $slug)
    {
        if (!empty($slug)) {
            $product = $this->where('slug', $slug);
            return $product;
        }
        return $query;
    }

    public function scopeSlugDifferent($query, $slug)
    {
        if (!empty($slug)) {
            $product = $this->where('slug_diffrent', '<>', $slug);
            return $product;
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        $query->orderBy('status', 'asc');
        if (!empty($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        } else {
            $query->orderBy('created_at', 'desc');
        }
        return $query;
    }

    public function scopeAndFeatures($query, $feature_ids)
    {
        if (!empty($feature_ids) && count($feature_ids) > 0) {
            return $query->whereHas('featureproductparent', function ($q) use ($feature_ids) {
                foreach ($feature_ids as $value) {
                    $q->where('feature_id', $value);
                }
            });
        }
        return $query;
    }

    public function scopeFeatures($query, $feature_ids)
    {
        if (!empty($feature_ids) && count($feature_ids) > 0) {
            return $query->whereHas('featureproductparent', function ($q) use ($feature_ids) {
                $q->whereIn('feature_id', $feature_ids);
            });
        }
        return $query;
    }

    public function scopeEqualFeaturesIn($query, $feature_ids)
    {
        if (!empty($feature_ids)) {
            $query->whereHas('features', function ($q) use ($feature_ids) {
                $q->whereIn('id', $feature_ids);
            });
        }
        return $query;
    }

    public function scopeEqualFeaturesInParent($query, $id_FeaturesInParent)
    {
        if (!empty($id_FeaturesInParent)) {
            $query->whereHas('featureproductparent', function ($q) use ($id_FeaturesInParent) {
                $q->whereIn('feature_id', $id_FeaturesInParent);
            });
        }
        return $query;
    }

    public function scopeidArray($query, $idArray)
    {
        if (!empty($idArray)) {
            $query->whereIn('product_id', $idArray);
        }
        return $query;
    }

    public function scopeGreatherThanQty($query, $value)
    {
        if (!empty($value)) {
            $query->where('qty', '>', $value)
                ->orWhere(function ($query2) use ($value) {
                    $query2->whereHas('children', function ($q) use ($value) {
                        $q->where('qty', '>', $value);
                    });
                });
        }
        return $query;
    }

    public function scopePriority($query, $value)
    {
        if (!empty($value)) {
            $query->whereIn('priority', $value);
        }
        return $query;
    }

    public function scopeIsNew($query, $value)
    {
        if (!empty($value)) {
            $query->where('isNew', $value);
        }
        return $query;
    }

    public function scopeEqualFeatures($query, $feature_ids)
    {
        if (!empty($feature_ids)) {
            foreach ($feature_ids as $feature_id) {
                if (!empty($feature_id)) {
                    $query->whereHas('features', function ($q) use ($feature_id) {
                        $q->where('feature_id', $feature_id);
                    });
                }
            }
        }
        return $query;
    }

    public function get_product($id)
    {
        if (!empty($id)) {
            $product = $this->where('product_id', $id)->get()->first();
            return is_null($product) ? false : $product;
        }
        return false;
    }

    public function get_product_by_code($product_code)
    {
        if (!empty($product_code)) {
            $product = $this->where('product_code', $product_code)->get()->first();
            return is_null($product) ? false : $product;
        }
        return false;
    }
    public function get_products_info($params = [])
    {
        $products = $this->query()
            ->name(@$params['name'])
            ->categories(@$params['category_ids'])
            ->parent_product_id(@$params['parent_product_id'])
            ->status(@$params['status']);

        $products->with(['images']);
        return !empty($params['limit']) ? $products->paginate($params['limit']) : $products->get();
    }
    public function get_products($params = [])
    {
        $products = $this->query()
            ->id(@$params['id'])
            ->DifferentId(@$params['different_id'])
            ->idArray(@$params['productArr_id'])
            ->code(@$params['product_code'])
            ->name(@$params['name'])
            ->child(@$params['has_child'])
            ->categories(@$params['category_ids'])
            ->sellPrice(@$params['sell_price'])
            ->status(@$params['status'])
            ->price(@$params['price'])
            ->brand(@$params['brand_id'])
            ->parent(@$params['parent'])
            ->qty(@$params['qty'])
            ->order(@$params['orderBy'])
            ->parent_product_id(@$params['parent_product_id'])
            ->Slug(@$params['slug'])
            ->SlugDifferent(@$params['slug_diffrent'])
            ->EqualFeaturesIn(@$params['id_FeaturesIn'])
            ->EqualFeaturesInParent(@$params['id_FeaturesInParent'])
            ->EqualFeatures(@$params['EqualFeatures_exactly']);

        $products->with(['images']);
        return !empty($params['limit']) ? $products->paginate($params['limit']) : $products->get();
    }

    public function searchproductindiscount($name, $count)
    {
        return $this->where('parent_product_id', '0')
            ->where('name', 'like', '%' . $name . '%')
            ->limit($count)->get();
    }

    public function updateProduct($param = [])
    {
        $data = $this->find(@$param['id']);
        $data->qty = @$param['qty'];
        $data->sold = empty($data->sold) || ($data->sold == 0) || ($data->sold == null) ? @$param['sold'] : $data->sold + @$param['sold'];
        $data->save();
        return $data->id;
    }

    public function getStarAttribute()
    {
        return $this->evaluate->where('status', 'A')->avg('star');
    }

    // public function getCategoryAttribute()
    // {
    //     return $this->categories->first();
    // }

    public function getPercentDiscountAttribute()
    {
        return 100 - round((@$this->sell_price / @$this->org_price) * 100, 2);
    }

    public function setCategoryIdsAttribute($value)
    {
        $this->attributes['category_ids'] = implode(',', $value);
    }

    public function setFeatureIdsAttribute($value)
    {
        $this->attributes['feature_ids'] = implode(',', $value);
    }

    public function setSellPriceAttribute($value)
    {
        $this->attributes['sell_price'] = (int)str_replace(",", "", $value);
    }

    public function setOrgPriceAttribute($value)
    {
        $this->attributes['org_price'] = (int)str_replace(",", "", $value);
    }

    public function lowestPrice($products)
    {
        return @$products->where('org_price', '>', 0)->sortBy('org_price')->first()->org_price;
    }

    public function highestPrice($products)
    {
        return @$products->where('org_price', '>', 0)->sortByDesc('org_price')->first()->org_price;
    }

    public function maxStar($products)
    {
        foreach ($products as $product) {
            $star = $product->evaluate->where('status', 'A')->max('star');
            if ($star) {
                $stars[] = $star;
            }
        }
        return collect($stars ?? [])->max();
    }

    public function minStar($products)
    {
        foreach ($products as $product) {
            $star = $product->evaluate->where('status', 'A')->min('star');
            if ($star) {
                $stars[] = $star;
            }
        }
        return collect($stars ?? [])->min();
    }

    public function ratingCount($products)
    {
        $count = 0;
        foreach ($products as $product) {
            $count += $product->evaluate->where('status', 'A')->count();
        }
        return $count;
    }

    public function getSellingProducts($limit = 10)
    {
        return $this->with(['categories', 'evaluate', 'images', 'children'])
                ->where('status', 'A')
                ->where('parent_product_id', 0)
                ->where('isSelling', 'Y')
                ->where(function ($query) {
                    $query->where('qty', '>', 0)
                        ->orWhere(function ($query2) {
                            $query2->whereHas('children', function ($q) {
                                $q->where('qty', '>', 0);
                            });
                        });
                })
                ->orderBy('priority', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate($limit);
    }

    public function checkStocking()
    {
        if (count($this->children) == 0) {
            return $this->qty > 0;
        }

        $check = $this->children->filter(function ($item) {
            return $item->qty > 0;
        });
        return count($check) > 0;
    }

    public function checkSaleProduct($limit = 10)
    {
        return $this->with(['categories', 'evaluate', 'images', 'children'])
        ->where('status', 'A')
        ->where('parent_product_id', 0)
        ->where('sell_price', '!=', 0)
        ->where('org_price', '>', 'sell_price')
        ->where(function ($query) {
            $query->where('qty', '>', 0)
                ->orWhere(function ($query2) {
                    $query2->whereHas('children', function ($q) {
                        $q->where('qty', '>', 0);
                    });
                });
        })
        ->orderBy('priority', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate($limit);
    }
}
