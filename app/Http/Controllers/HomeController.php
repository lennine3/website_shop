<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Setting\Entities\Setting;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;
use App\Models\SlugOptimize;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogCategory;
use App\Models\PricingTable;
use App\Models\Faq;
use App\Models\SectionInfo;
use App\Models\DesignService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;

class HomeController extends Controller
{
    private $setting;
    private $blog;
    private $blogCategory;
    private $product;
    private $category;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->setting= new Setting();
        $this->blog = new Blog();
        $this->blogCategory = new BlogCategory();
        $this->product=new Product();
        $this->category=new Category();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $webDesignInfo=SectionInfo::findOrFail(1);
        $designService=DesignService::all();

        $aboutInfo=SectionInfo::findOrFail(7);

        $pricingTable=PricingTable::all();
        $faq=Faq::all();
        $marketingService=Blog::where('blog_Category_id', 2)->status('A')->get();
        $marketingBlog=Blog::where('blog_Category_id', 1)->status('A')->get();
        // dd($marketingBlog);
        return view('home', compact('pricingTable', 'faq', 'marketingBlog', 'marketingService', 'webDesignInfo', 'designService', 'aboutInfo'));
    }
    public function handleURL($alias = '')
    {
        // dd($alias);
        // $slug = explode('.', $alias);

        // if (@$slug[1] != null) {
        //     return view('errors.404');
        // }
        $getSlug = !empty($alias) ? SlugOptimize::slug(['slug' => $alias])->first() : new SlugOptimize();
        // $params = [@$getSlug->slug];
        $params = @$getSlug->slug;
        if (@$getSlug->type == SlugOptimize::TYPE_BLOG_CATE) {
            $response = $this->blogCategory($params);
        } elseif (@$getSlug->type == SlugOptimize::TYPE_BLOG) {
            $response = $this->blogDetail($params);
        } elseif (@$getSlug->type == SlugOptimize::TYPE_CATE_PRODUCT) {
            $response = $this->category($params);
        }
        if (isset($response)) {
            return $response;
        }
        return $this->get404();
    }
    public function get404()
    {
        abort(404);
    }
    public function changeLanguage($language)
    {
        session(['website_language' => $language]);
        return redirect()->back();
    }
    public function processContact()
    {
        $data = request()->except('_token');
        $validator = Validator::make(request()->all(), [
            'phone' => 'numeric|digits_between:10,11|regex:/^0\d+$/',
        ], [
            'phone.*' => '(*) Số điện thoại chưa đúng, vui lòng nhập lại',
        ]);
        if ($validator->fails()) {
            return response()->json(['text'=>'fail','errors'=>$validator->errors()]);
        }

        $settings = $this->setting->get_settings();

        $generals = [];
        if (count(@$settings) > 0) {
            foreach ($settings as $setting) {
                $generals[$setting->type] = unserialize($setting->data);
            }
        }
        $newFeedback = Contact::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'service'=>$data['service'],
            'status' => 'N',
        ]);
        return response()->json(['success' => 'Cảm ơn bạn đã gửi phản hồi đến chúng tôi.','message'=>'success']);
    }
    public function blogCategory($params)
    {
        $blog_category=$this->blogCategory->findBySlugOrId($params);
        return view('web.blog.blogCategory', compact('blog_category'));
    }
    public function blogDetail($params)
    {
        $blogData=$this->blog->findBySlugOrId($params);
        $relatedBlog=$this->blog->get_blogs_related(4, $blogData->blog_category_id, $blogData->id);
        return view('web.blog.blogDetail', compact('blogData', 'relatedBlog'));
    }
    public function category($params)
    {
        $cateData=$this->category->findBySlugOrId($params);
        // dd($productData->products);
        $productList=$this->product->get_products_info(['category_ids'=>$cateData->id,'limit'=>40]);
        // dd($products);
        return view('web.product.category', compact('cateData', 'productList'));
    }
    public function clearCache()
    {
        Cache::flush();
        return redirect()->back();
    }
}
