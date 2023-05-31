@php
    use App\Modules\Product\Models\Product;
    use App\Modules\Product\Models\Category;
    use App\Modules\Location\Models\State;
    use App\Modules\Location\Models\District;
    $home = [
        '@type' => 'ListItem',
        'position' => 1,
        'item' => [
            '@id' => (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]",
            'name' => 'Home',
        ],
    ];
    $schema_cate[] = $home;
    foreach ($banner_slide_home as $value) {
        $image[] = show_image(config('banner.image.org_path'), @$value->avatar);
    }
    $products = Product::all();
    $lowest_price = Number_format((new Product())->lowestPrice($products));
    $highest_price = Number_format((new Product())->highestPrice($products));

    $schema = [
        '@context' => 'http://schema.org',
        '@type' => 'LocalBusiness',
        '@id' => $current_link,
        'url' => $current_link,
        'additionaltype' => [
            '
        https://vi.wikipedia.org/wiki/Thi%E1%BA%BFt_b%E1%BB%8B_y_t%E1%BA%BF',
            'https://en.wikipedia.org/wiki/Medical_device',
        ],
        'logo' => $logo,
        'image' => $image ?? [],
        'priceRange' => "{$lowest_price} vnđ - {$highest_price} vnđ",
        'hasMap' => @$generals['SOCIAL']['maps'],
        'email' => @$generals['SHOP']['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => @District::find(@$generals['SHOP']['district_id'])->name,
            'addressCountry' => 'VIỆT NAM',
            'addressRegion' => @State::find(@$generals['SHOP']['state_id'])->name,
            'postalCode' => '700000',
            'streetAddress' => @$generals['SHOP']['address'],
        ],
        'description' => @$generals['SHOP']['seo_description'],
        'name' => @$generals['SHOP']['shop_name'],
        'telephone' => @$generals['SHOP']['phone'],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => @$generals['SHOP']['position'],
            'longitude' => @$generals['SHOP']['position'],
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Wednesday', 'Tuesday', 'Thursday', 'Friday'],
                'opens' => '08:30',
                'closes' => '18:00',
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Saturday', 'Sunday'],
                'opens' => '08:30',
                'closes' => '12:00',
            ],
        ],
        'sameAs' => [@$generals['SOCIAL']['facebook'], @$generals['SOCIAL']['youtube'], @$generals['SOCIAL']['twitter'], @$generals['SOCIAL']['instagram'], @$generals['SOCIAL']['tiktok'], @$generals['SOCIAL']['linkedin']],
    ];
    foreach ($schema as $key => $value) {
        if (empty($value)) {
            unset($schema[$key]);
        }
    }
    foreach ($schema['sameAs'] as $value) {
        if (!empty($value)) {
            $arr[] = $value;
        }
    }
    $schema['sameAs'] = @$arr;
    $schema = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $schemaBreadCrum = [
        '@context' => 'http://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $schema_cate,
    ];
    $schemaBreadCrum = json_encode($schemaBreadCrum, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

@section('head')
    @php echo '<script type="application/ld+json">'; @endphp
        {!! @$schema !!}
    @php echo '</script>'; @endphp
    @php echo '<script type="application/ld+json">'; @endphp
        {!! @$schemaBreadCrum !!}
    @php echo '</script>'; @endphp
@endsection
