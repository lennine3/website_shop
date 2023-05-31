<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\PricingTable;
use Illuminate\Support\Arr;
use App\Models\SectionInfo;
use App\Models\UiDesign;
use App\Libraries\Upload;
use App\Models\Benefit;
use App\Models\DesignService;

class AjaxAdminController extends Controller
{
    public function processSectionInfo(Request $request)
    {
        $benefitInfo=SectionInfo::find($request->sectionInfo_id);
        $benefitInfo->update($request->except('sectionInfo_id'));
        return response()->json(['message' => 'Dữ liệu đã thay đổi']);
    }

    public function processWebDesign(){
        $inputs = request()->except(['_token']);
        $data=Arr::only($inputs, ['title', 'content']);
        $serviceBenefit=DesignService::find($inputs['webDesign_id']);
        $serviceBenefit->update($data);
        return response()->json(['message' => 'Dữ liệu đã thay đổi']);
    }
}
