<?php

namespace Modules\Product\Services;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Illuminate\Support\Arr;

use function App\Libraries\StripSlug;

class ProductServiceProcess
{
    public function execute($product, $inputs)
    {
        $data=Arr::only($inputs, ['name', 'product_code', 'slug','category_id','org_price','sell_price','qty','description','product_content', 'status','priority']);

        $id = request('id', 0);
        $user_id = auth()->user()->id;
        if (empty($id)) {
            $product->user_id = $user_id;
            $product->has_child = 'N';
        }
        foreach ($data as $key => $val) {
            $product->$key = $val;
        }
        $product->product_code = request('product_code', $product->id);
        $product->qty = isset($product->qty) ? $product->qty : 0;
        $slug=StripSlug($data['name']);
        $product->slug=$slug;

        $product->save();
    }

    public function childExecute($product, $data)
    {
        $user_id = auth()->user()->id;
        $product->has_child = 'N';
        foreach ($data as $key => $val) {
            $product->$key = $val;
        }
        $product->slug=$data['slug'];

        $product->save();
    }
}
