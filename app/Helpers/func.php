<?php

use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\URL;

if (!function_exists('show_logo')) {
    function show_logo()
    {
        $setting = new Setting();
        $item = $setting->get_type_setting('LOGO');
        $logoName = unserialize(@$item->data);
        $image_path = 'storage/' . $logoName;
        if (config('app.asset_url') != null) {
            $path = substr(config('app.asset_url') . '/' . $image_path, 1);
        }

        if (file_exists($path)) {
            return asset($image_path);
        }
        return asset('logos/logo.png');
    }
}

if (!function_exists('webpFormat')) {
    function webpFormat($image)
    {
        return str_replace("jpg", "webp", str_replace("png", "webp", str_replace("jpeg", "webp", $image)));
    }
}

if (!function_exists('is_serialized')) {
    function is_serialized($value)
    {
        // If the value is not a string or is empty, it's not serialized
        if (!is_string($value) || trim($value) === '') {
            return false;
        }

        // If the value is not serialized with PHP, it's not serialized
        if (preg_match('/^(i|s|a|o|d)(.*);/si', $value, $matches) !== 1) {
            return false;
        }

        // If the serialized value can be unserialized, it's serialized
        return @unserialize($value) !== false;
    }
}

if (!function_exists('show_favicon')) {
    function show_favicon($path)
    {
        return URL::to('/favicon.ico');

        $image_path = $path;
        if (config('app.asset_url') != null) {
            $path = substr(config('app.asset_url') . '/' . $path, 1);
        }

        if (file_exists($path)) {
            return asset($image_path);
        }
        return asset('favicon.ico');
    }
}

if (!function_exists('checkPricingTable')) {
    function checkPricingTable($value)
    {
        if (is_numeric($value)) {
            $formattedValue = number_format($value, 0, '.', ',');
            return $formattedValue.' đ';
        } else {
            return $value;
        }
    }
}
