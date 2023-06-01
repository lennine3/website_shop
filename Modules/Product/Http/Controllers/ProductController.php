<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\SlugOptimize;
use App\Models\Seo;
use App\Libraries\Upload;
use Modules\Product\Entities\Product;
use Modules\Product\Services\ProductServiceProcess;
use Modules\Product\Entities\Feature;
use Modules\Product\Entities\ProductFeature;

use function App\Libraries\StripSlug;

class ProductController extends Controller
{
    private $seo;
    private $slug_optimize;
    private $upload;
    private $product_service;
    private $product;
    public function __construct()
    {
        $this->seo=new Seo();
        $this->slug_optimize=new SlugOptimize();
        $this->upload=new Upload();
        $this->product_service= new ProductServiceProcess();
        $this->product= new Product();
    }
    public function index()
    {
        $categories=Category::where('parent_id', 0)->get();
        return view('product::cate_product.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories=Category::all();
        return view('product::cate_product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function categoryProcess()
    {
        $message=trans('product::product.controller.success.add');

        $inputs = request()->except(['_token']);
        $slug=StripSlug($inputs['title']);
        $data=Arr::only($inputs, ['title', 'description', 'parent_id', 'status','priority']);
        $data['slug']=$slug;
        $seoData=Arr::only($inputs, ['seo_title','seo_description','seo_keyword']);
        $seo = Seo::updateOrCreate(['object_id' => $inputs['product_cate_id'], 'type' => Seo::PRODUCT_CATE], $seoData);
        $product_cate= $inputs['product_cate_id'] ? Category::findOrFail($inputs['product_cate_id']) : Category::create($data);
        if (request()->hasFile('productCateImage')) {
            $file = request()->file('productCateImage');
            $source_path = config('product.image.image_save_path').'/'.$product_cate->id.'/';
            $result=$this->upload->doUploadBlog($source_path, $file, "", []);
            $image=$product_cate->image;
            $webp_image=$product_cate->webp_path;

            if (isset($image) && (file_exists($source_path . "/" . $image) == '1')) {
                unlink($source_path . "/" . $image);
            }
            if (isset($webp_image) && (file_exists($source_path . "/" . $webp_image) == '1')) {
                unlink($source_path . "/" . $webp_image);
            }
            $imageName = $result['name'];
            $webpImageName=$result['webp_name'];
        }
        if (isset($imageName)) {
            $data['image'] = $imageName;
        }
        if (isset($webpImageName)) {
            $data['webp_path'] = $webpImageName;
        }
        $product_cate->update($data);
        if ($inputs['product_cate_id']) {
            $message=trans('product::product.controller.success.update');
        }

        // createOrUpdate Slug
        $this->slug_optimize->updateOrCreate(['object_id' => $product_cate->id, 'type' => SlugOptimize::TYPE_CATE_PRODUCT], ['slug' => $slug]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function edit(Category $product_cate)
    {
        $categories=Category::all();
        return view('product::cate_product.create', compact('product_cate', 'categories'));
    }

    public function productCreate()
    {
        $productList=Product::all();
        $categories=Category::all();
        $features=Feature::where('parent_id', 0)->get();
        return view('product::product.create', compact('productList', 'categories', 'features'));
    }

    public function productProcess()
    {
        $message=trans('product::product.controller.success.add');

        $inputs = request()->except(['_token']);
        $featureInputs = $inputs['feature'];

        $product = !empty($inputs['product_id']) ? product::findOrFail($inputs['product_id']) : $this->product;
        $this->product_service->execute($product, $inputs);

        // Product feature
        if (count(ProductFeature::where('product_id', $product->product_id)->get())>1) {
            ProductFeature::where('product_id', $product->product_id)->delete();
        }
        foreach ($featureInputs as $featureInput) {
            if ($featureInput != null&&$featureInput!=0) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'feature_id' => $featureInput,
                    'parent_product_id' => 0,
                ]);
            }
        }
        // createOrUpdate Seo
        $seoData=Arr::only($inputs, ['seo_title','seo_description','seo_keyword']);
        Seo::updateOrCreate(['object_id' => $inputs['product_id'], 'type' => Seo::PRODUCT], $seoData);
        // createOrUpdate Slug
        $this->slug_optimize->updateOrCreate(['object_id' => $product->id   , 'type' => SlugOptimize::TYPE_PRODUCT], ['slug' => $product->slug]);

        if ($inputs['product_id']) {
            $message=trans('product::product.controller.success.update');
        }
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function productChildProcess()
    {
        $message=trans('product::product.controller.success.add');

        $inputs = request()->except(['_token']);
        $parentProduct=Product::findOrFail($inputs['product_parent_id']);
        $featureInputs = $inputs['feature'];
        $data=Arr::only($inputs, ['name', 'product_code','org_price','sell_price','qty', 'status','priority']);
        $data['slug']=$parentProduct->slug;
        $data['category_id']=$parentProduct->category_id;
        $data['description']=$parentProduct->description;
        $data['product_content']=$parentProduct->product_content;
        $data['parent_product_id']=$parentProduct->id;

        $product = !empty($inputs['product_child_id']) ? product::findOrFail($inputs['product_child_id']) : $this->product;

        $this->product_service->childExecute($product, $data);
        // Product feature
        if (count(ProductFeature::where('product_id', $product->product_id)->get())>1) {
            ProductFeature::where('product_id', $product->product_id)->delete();
        }
        foreach ($featureInputs as $featureInput) {
            if ($featureInput != null&&$featureInput!=0) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'feature_id' => $featureInput,
                    'parent_product_id' => 0,
                ]);
            }
        }
        $parentProduct->has_child='Y';
        $parentProduct->save();
        $product=$parentProduct;
        $html = view('product::product.child-left-form', compact('product'))->render();

        return response()->json([
            'success' => true,
            'message' => $message,
            'html'=>$html
        ]);
    }
    public function productChildEdit(Product $product)
    {
        $productList=Product::all();
        $categories=Category::all();
        $showScript=true;
        $features=Feature::where('parent_id', 0)->get();
        $html = view('product::product.child-right-form', compact('product', 'productList', 'categories', 'features', 'showScript'))->render();
        return response()->json(['message' => 'Dữ liệu đã thay đổi','html'=>$html]);
    }
    public function productEdit(Product $product)
    {
        $productList=Product::all();
        $categories=Category::all();
        $features=Feature::where('parent_id', 0)->get();
        return view('product::product.create', compact('productList', 'categories', 'features', 'product'));
    }
}
