<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\PricingTable;
use Illuminate\Support\Arr;
use App\Models\SectionInfo;
use App\Models\DesignService;


class AdminController extends Controller
{
    private $pricingTable;
    public function __construct()
    {
        $this->pricingTable= new PricingTable();
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function homePage()
    {
        $faq=Faq::all();
        $pricingTable=PricingTable::all();
        $webDesignInfo=SectionInfo::findOrFail(1);
        $aboutInfo=SectionInfo::findOrFail(7);
        $designService=DesignService::all();
        return view('admin.home.index', compact('faq', 'pricingTable', 'webDesignInfo', 'designService', 'aboutInfo'));
    }
    public function pricingEdit(PricingTable $pricingTableData)
    {
        $faq=Faq::all();
        $pricingTable=PricingTable::all();
        $webDesignInfo=SectionInfo::findOrFail(1);
        $aboutInfo=SectionInfo::findOrFail(7);
        $designService=DesignService::all();
        return view('admin.home.index', compact('faq', 'pricingTable', 'pricingTableData', 'webDesignInfo', 'aboutInfo', 'designService'));
    }
    public function processFaqQuestion(Request $request)
    {
        if (($request->faqQuestion_id)!=null) {
            $faq=Faq::find($request->faqQuestion_id);
            $faq->update($request->except('faqQuestion_id'));
        } else {
            $faq=new Faq();
            $faq->create($request->all());
        }
        $faq=Faq::get();
        $html = view('admin.home.faqList', compact('faq'))->render();
        return response()->json(['message' => 'Dữ liệu đã thay đổi','html'=>$html]);
    }

    public function processPricingTable()
    {
        $inputs = request()->except(['_token']);
        $data=Arr::only($inputs, ['title','price', 'note', 'saleNote', 'otherNote','otherNote_1']);
        $filteredPricingFunc = array_values(array_filter(request('pricing_func'), function ($value) {
            return $value !== null;
        }));
        $jsonPricingFuncData = json_encode(["pricing_func" => $filteredPricingFunc], JSON_UNESCAPED_UNICODE);
        $jsonPricingFuncData = str_replace('\/', '/', $jsonPricingFuncData);

        $data['pricing_func']=$jsonPricingFuncData;
        $pricingTable = $inputs['pricing_id'] ? PricingTable::findOrFail($inputs['pricing_id']) : PricingTable::create($data);
        if ($inputs['pricing_id']) {
            $pricingTable->update($data);
        }
        $pricingTable=PricingTable::all();
        // $html = view('admin.home.prcing-list', compact('pricingTable'))->render();
        return response()->json([
            'message' => 'Đã thêm dữ liệu thành công',
            'redirect' => route('admin.home-setting'), // Replace "desired.route.name" with the name of your desired route
        ]);
    }
}
