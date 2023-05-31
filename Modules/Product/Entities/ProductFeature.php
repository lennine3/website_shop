<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $table = 'product_features';
    public $timestamps = false;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('Modules\Product\Entities\Product', 'product_id', 'product_id');
    }

    public function feature()
    {
        return $this->belongsTo('Modules\Product\Entities\Feature', 'feature_id', 'id');
    }

    public function productcategory()
    {
        return $this->hasMany('Modules\Product\Entities\ProductCategory', 'product_id', 'parent_product_id');
    }

    public function scopeEquaproductcategory($query, $categoris_id)
    {
        if (!empty($categoris_id)) {
            return $query->whereHas('productcategory', function ($q) use ($categoris_id) {
                $q->whereIn('category_id', $categoris_id);
            });
        }
    }

    public function delete($params = [])
    {
        if (!empty($params['product_id'])) {
            $this->where('product_id', $params['product_id'])->delete();
        }
        if (!empty($params['feature_id'])) {
            $this->where('feature_id', $params['feature_id'])->delete();
        }
    }

    public function get_product_feature($feature_id)
    {
        return $this->where('feature_id', $feature_id)->get();
    }

    public function scopeProductParent($query, $parent_product_id)
    {
        if (!empty($parent_product_id)) {
            $query->where('parent_product_id', $parent_product_id);
        }
        return $query;
    }

    public function scopeFeatureId($query, $FeatureId)
    {
        if (!empty($FeatureId)) {
            $query->where('feature_id', $FeatureId);
        }
        return $query;
    }

    public function get_productfeature($params = [])
    {
        $categori = $this->query()
            ->Equaproductcategory(@$params['product_code'])
            ->FeatureId(@$params['FeatureId'])
            ->ProductParent(@$params['product_parent']);
        return !empty($params['limit']) ? $categori->paginate($params['limit']) : $categori->get();
    }
}
