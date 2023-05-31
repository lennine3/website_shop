<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use App\Libraries\Upload;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    private $setting;
    public function __construct()
    {
        $this->setting= new Setting();
    }
    public function index()
    {
        $settings = $this->setting->get_settings();
        $generals = [];
        foreach ($settings as $setting) {
            $generals[$setting->type] = unserialize($setting->data);
        }
        return view('setting::index', ['generals' => $generals]);
    }

    public function process(Request $request)
    {
        $inputs = request()->except(['_token','image','favicon']);
        foreach ($inputs as $type => $input) {
            $item = $this->setting->get_type_setting($type);
            $setting = !empty($item) ? $item : new Setting();
            $setting->type = $type;

            $setting->data = serialize($input);
            $setting->save();
        }

        if (request()->hasFile('image')) {
            $upload = new Upload();
            $file = request()->image;
            $image_path = '/Logo';
            $item = $this->setting->get_type_setting('LOGO');
            $setting = !empty($item) ? $item : new Setting();
            $setting->type = 'LOGO';
            $setting->data = serialize($upload->doUploadLogo($image_path, $file));
            $setting->save();
        }
        if (request()->hasFile('favicon')) {
            $file = request()->file('favicon');
            $file->move(base_path(), 'favicon.ico');
        }
        Cache::flush();
        $message = trans('setting::setting.controller.success');

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
