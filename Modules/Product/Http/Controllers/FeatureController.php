<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Feature;
use Illuminate\Support\Arr;
use App\Libraries\Upload;

class FeatureController extends Controller
{
    private $upload;
    public function __construct()
    {
        $this->upload=new Upload();
    }
    public function index()
    {
        $features=Feature::where('parent_id',0)->get();
        return view('product::feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $features=Feature::where('parent_id', 0)->get();
        return view('product::feature.create', compact('features'));
    }

    public function featureProcess()
    {
        $message=trans('product::product.controller.success.add');

        $inputs = request()->except(['_token']);
        $data=Arr::only($inputs, ['name', 'parent_id', 'status']);
        $feature= $inputs['feature_id'] ? Feature::findOrFail($inputs['feature_id']) : Feature::create($data);
        if (request()->hasFile('featureImage')) {
            $file = request()->file('featureImage');
            $source_path = config('product.image.feature_image_save_path').'/'.$feature->id.'/';
            $result=$this->upload->doUploadBlog($source_path, $file, "", []);
            $image=$feature->image;
            $webp_image=$feature->webp_path;

            if (isset($image) && (file_exists($source_path . "/" . $image) == '1')) {
                unlink($source_path . "/" . $image);
            }
            if (isset($webp_image) && (file_exists($source_path . "/" . $webp_image) == '1')) {
                unlink($source_path . "/" . $webp_image);
            }
            $imageName = $result['name'];
            $webpImageName=$result['webp_name'];
        }
        // if (isset($imageName)) {
        //     $data['image'] = $imageName;
        // }
        if (isset($webpImageName)) {
            $data['option'] = $webpImageName;
        }
        if ($inputs['feature_id']) {
            $feature->update($data);
        } else {
            $feature->update(['option'=>$data['option']]);
        }
        return response()->json([
            'success' => true,
            'message' => $message,
            'route'=> route('product.feature.edit',['feature'=>$feature->id])
        ]);
    }

    public function edit(Feature $feature)
    {
        $features=Feature::where('parent_id', 0)->get();
        return view('product::feature.create',compact('feature','features'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
