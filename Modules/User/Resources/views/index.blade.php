@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/table/datatable/dt-global_style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/table/datatable/custom_dt_custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/table/datatable/dt-global_style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/table/datatable/custom_dt_custom.css') }}"
        type="text/css">
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <table id="style-3" class="table style-3 dt-table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column text-center"> Record Id </th>
                                    <th class="text-center">Image</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th class="text-center dt-no-sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="checkbox-column text-center"> {{ $user->id }} </td>
                                        <td class="text-center">
                                            <span><img
                                                    src="{{ $user->avatar != null ? asset(config('user.image.path') . $user->id . '/' . $user->avatar) : asset('admin/assets/img/blank.png') }}"
                                                    class="profile-img" alt="avatar"></span>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li>
                                                    <a href="{{ route('users.setting', ['user' => $user->id]) }}"
                                                        class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit" data-original-title="Edit">
                                                        <i data-feather="edit-2" class="p-1 br-8 mb-1"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/plugins/src/global/vendors.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script>
        c3 = $('#style-3').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 10
        });

        multiCheck(c3);
    </script>
@endsection
