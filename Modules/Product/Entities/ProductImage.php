<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $guarded = [];
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function delete_image($image_id)
    {
        if (!empty($image_id)) {
            $this->where('id', $image_id)->delete();
        }
    }

    public function get_image($id)
    {
        if (!empty($id)) {
            $image = $this->where('id', $id)->get()->first();
            return is_null($image) ? false : $image;
        }
        return false;
    }
}
