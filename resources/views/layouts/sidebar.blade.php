<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('admin/assets/img/logo.svg') }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"> CORK </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            {{-- Dashboard --}}
            <li class="menu {{ $routeName == 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>@lang('menu.dashboard')</span>
                    </div>
                </a>
            </li>

            {{-- Home layout --}}
            <li
                class="menu {{ $routeName == 'admin.home-setting' || $routeName == 'admin.edit.pricing-table' ? 'active' : '' }}">
                <a href="{{ route('admin.home-setting') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="layout"></i>
                        <span>@lang('menu.home')</span>
                    </div>
                </a>
            </li>

            {{-- Product --}}
            <li class="menu menu-heading">
                <div class="heading"><i data-feather="minus"></i><span>@lang('menu.product.header')</span></div>
            </li>
            @php
                $productCateCheck = ['product.category.index', 'product.category.create', 'product.category.edit'];
                $featureCheck = ['product.feature.index', 'product.feature.create', 'product.feature.edit'];
                $productCheck = ['product.create'];
            @endphp
            <li
                class="menu {{ in_array($routeName, $productCheck) || in_array($routeName, $productCateCheck) || in_array($routeName, $featureCheck) ? 'active' : '' }}">
                <a href="#productMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="settings"></i>
                        <span>@lang('menu.product.header_sub')</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ in_array($routeName, $productCheck) || in_array($routeName, $productCateCheck) || in_array($routeName, $featureCheck) ? 'show' : '' }}"
                    id="productMenu" data-bs-parent="#accordionExample">
                    <li>
                        <a href="#product-category-menu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed"> @lang('menu.product.sub.product_category.header') <i data-feather="chevron-right"></i>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu {{ in_array($routeName, $productCateCheck) ? 'show' : '' }}"
                            id="product-category-menu" data-bs-parent="#pages">
                            <li class="{{ $routeName == 'product.category.index' ? 'active' : '' }}">
                                <a href="{{ route('product.category.index') }}">
                                    @lang('menu.product.sub.product_category.list')
                                </a>
                            </li>
                            <li
                                class="{{ $routeName == 'product.category.create' || $routeName == 'product.category.edit' ? 'active' : '' }}">
                                <a href="{{ route('product.category.create') }}">
                                    @lang('menu.product.sub.product_category.add')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#product-feature-menu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed"> @lang('menu.product.sub.feature.header') <i data-feather="chevron-right"></i>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu {{ in_array($routeName, $featureCheck) ? 'show' : '' }}"
                            id="product-feature-menu" data-bs-parent="#pages">
                            <li class="{{ $routeName == 'product.feature.index' ? 'active' : '' }}">
                                <a href="{{ route('product.feature.index') }}">
                                    @lang('menu.product.sub.feature.list')
                                </a>
                            </li>
                            <li
                                class="{{ $routeName == 'product.feature.create' || $routeName == 'product.feature.edit' ? 'active' : '' }}">
                                <a href="{{ route('product.feature.create') }}">
                                    @lang('menu.product.sub.feature.add')
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#product-menu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed"> Sản phẩm <i data-feather="chevron-right"></i>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu {{ in_array($routeName, $productCheck) ? 'show' : '' }}"
                            id="product-menu" data-bs-parent="#pages">
                            {{-- <li class="{{ $routeName == 'product.category.index' ? 'active' : '' }}">
                                <a href="{{ route('product.category.index') }}">
                                    @lang('menu.product.sub.product_category.list')
                                </a>
                            </li> --}}
                            <li
                                class="{{ $routeName == 'product.create' || $routeName == 'product.edit' ? 'active' : '' }}">
                                <a href="{{ route('product.create') }}">
                                    Thêm mới
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- Blog --}}
            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>@lang('menu.post.header')</span>
                </div>
            </li>
            @php
                $blogCategoryCheck = ['blog.category.index', 'admin.blog.category.create', 'admin.blog.category.edit'];
                $blogCheck = ['blog.index', 'blog.create', 'blog.edit'];
            @endphp
            <li
                class="menu {{ in_array($routeName, $blogCategoryCheck) || in_array($routeName, $blogCheck) ? 'active' : '' }}">
                <a href="#blogMenuParent" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="settings"></i>
                        <span>@lang('menu.post.header_sub')</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ in_array($routeName, $blogCategoryCheck) || in_array($routeName, $blogCheck) ? 'show' : '' }}"
                    id="blogMenuParent" data-bs-parent="#accordionExample">
                    <li>
                        <a href="#blog-category-menu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed"> @lang('menu.post.sub.blog_category.header') <i data-feather="chevron-right"></i>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu {{ in_array($routeName, $blogCategoryCheck) ? 'show' : '' }}"
                            id="blog-category-menu" data-bs-parent="#pages">
                            <li class="{{ $routeName == 'blog.category.index' ? 'active' : '' }}">
                                <a href="{{ route('blog.category.index') }}">
                                    @lang('menu.post.sub.blog_category.list')
                                </a>
                            </li>
                            <li
                                class="{{ $routeName == 'admin.blog.category.create' || $routeName == 'admin.blog.category.edit' ? 'active' : '' }}">
                                <a href="{{ route('admin.blog.category.create') }}">
                                    @lang('menu.post.sub.blog_category.add')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#blog-menu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed"> @lang('menu.post.sub.blog.header') <i data-feather="chevron-right"></i>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu {{ in_array($routeName, $blogCheck) ? 'show' : '' }}"
                            id="blog-menu" data-bs-parent="#pages">
                            <li class="{{ $routeName == 'blog.index' ? 'active' : '' }}">
                                <a href="{{ route('blog.index') }}">
                                    @lang('menu.post.sub.blog.list') </a>
                            </li>
                            <li
                                class="{{ $routeName == 'blog.create' || $routeName == 'blog.edit' ? 'active' : '' }}">
                                <a href="{{ route('blog.create') }}">
                                    @lang('menu.post.sub.blog.add') </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- User --}}
            <li class="menu menu-heading">
                <div class="heading">
                    <i data-feather="minus"></i>
                    <span>@lang('menu.user.header')</span>
                </div>
            </li>

            @php
                $userCheck = ['users.index', 'users.setting'];
            @endphp
            <li class="menu {{ in_array($routeName, $userCheck) ? 'active' : '' }}">
                <a href="#users" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>@lang('menu.user.header_sub')</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $routeName == 'users.index' || $routeName == 'users.setting' ? 'show' : '' }}"
                    id="users" data-bs-parent="#accordionExample">
                    <li class="{{ $routeName == 'users.index' ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">@lang('menu.user.sub.list')</a>
                    </li>
                    <li class="{{ $routeName == 'users.setting' ? 'active' : '' }}">
                        <a href="{{ route('users.setting', ['user' => Auth::user()->id]) }}">@lang('menu.user.sub.profile')</a>
                    </li>
                </ul>
            </li>

            {{-- Administrator --}}
            @if (Auth::user()->hasPermissionTo('view administrator'))
                <li class="menu menu-heading">
                    <div class="heading"><i data-feather="minus"></i><span>@lang('menu.administrator.header')</span></div>
                </li>
                @php
                    $administratorCheck = ['roles.edit', 'roles.page', 'permission.page', 'permission.edit'];
                @endphp
                <li class="menu {{ in_array($routeName, $administratorCheck) ? 'active' : '' }}">
                    <a href="#administrator" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <div class="">
                            <i data-feather="shield"></i>
                            <span>@lang('menu.administrator.header')</span>
                        </div>
                        <div>
                            <i data-feather="chevron-right"></i>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ in_array($routeName, $administratorCheck) ? 'show' : '' }}"
                        id="administrator" data-bs-parent="#accordionExample">
                        <li class="{{ $routeName == 'roles.page' || $routeName == 'roles.edit' ? 'active' : '' }}">
                            <a href="{{ route('roles.page') }}">@lang('menu.administrator.sub.role')</a>
                        </li>
                        <li
                            class="{{ $routeName == 'permission.page' || $routeName == 'permission.edit' ? 'active' : '' }}">
                            <a href="{{ route('permission.page') }}"> @lang('menu.administrator.sub.permission') </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Setting --}}
            <li class="menu menu-heading">
                <div class="heading"><i data-feather="minus"></i><span>@lang('menu.setting.header')</span></div>
            </li>
            @php
                $settingCheck = ['setting.index'];
            @endphp
            <li class="menu {{ in_array($routeName, $settingCheck) ? 'active' : '' }}">
                <a href="#settingMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="settings"></i>
                        <span>@lang('menu.setting.header_sub')</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ in_array($routeName, $settingCheck) ? 'show' : '' }}"
                    id="settingMenu" data-bs-parent="#accordionExample">
                    <li class="{{ $routeName == 'setting.index' ? 'active' : '' }}">
                        <a href="{{ route('setting.index') }}">
                            @lang('menu.setting.sub.website') </a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

</div>
