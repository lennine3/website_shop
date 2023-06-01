<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\ProductImage;
use App\Libraries\Upload;
use Modules\Product\Entities\Product;
class DropzoneController extends Controller
{
    private $upload;
    public function __construct()
    {
        $this->upload=new Upload();
    }
    public function process(Request $request)
    {
        // dd($request->all());
        $hasFile = $request->file('file');
        if ($request->file('file')) {
            $image=new ProductImage();
            $image->user_id = auth()->id();
            $image->product_id = $request->product_id;
            $image->save();

            $file = $request->file('file');
            $source_path = config('product.image.product_image_save_path').'/'.$request->product_id.'/';
            $result=$this->upload->doUploadBlog($source_path, $file, "", []);

            $image->image_path = $result['name'];
            $image->webp_path=$result['webp_name'];
            $image->image_width = $result['width'];
            $image->image_height = $result['height'];

            $image->save();
        }
        $showScript=true;
        $product=Product::findOrFail($request->product_id);
        $html = view('product::product.tr_item', compact('product','showScript'))->render();

        return response()->json(['success' => true,'html'=>$html,'message'=>'Đã thêm ảnh vào sản phẩm']);
    }

    public function sortTable()
    {
        $inputs = request()->except(['_token']);
        foreach ($inputs as $index => $item) {
            $image=ProductImage::findOrFail($item[0]);
            $image->position=$item[1];
            $image->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Sắp xếp hình ảnh thành công',
        ]);
    }
    public function deleteImg()
    {
        $inputs = request()->except(['_token']);
        $image=ProductImage::findOrFail($inputs['rowId']);
        $image->delete();
        return response()->json([
            'success' => true,
            'message' => 'Hình sản phẩm đã được xóa',
        ]);
    }
}
