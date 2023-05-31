<form id="productForm" action="#" method="POST">
    @csrf
    <input type="text" value="{{ @$product->id }}" name="product_id" hidden>
    <div class="row layout-top-spacing">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    @lang('product::product.product.header.' . (@$product->id ? 'edit' : 'add'))
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="name" class="form-label">@lang('product::product.product.title')<span
                                    class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ @$product->name }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="product_code" class="form-label">@lang('product::product.product.product_code')<span
                                    class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" id="product_code" name="product_code"
                                value="{{ @$product->product_code }}" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="slug" class="form-label">slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ @$product->slug }}" readonly>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="cate-select" class="form-label">@lang('product::product.category.parent_category'):
                                {{ @$product->category_id != 0 ? @$product->category->title : 'Không có danh mục nào' }}
                            </label>
                            <select id="cate-select" name="category_id" placeholder="Select your parent"
                                autocomplete="off">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ @$product->category_id == $item->id ? 'selected' : '' }}>
                                        {{ @$item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="slug" class="form-label">Giá nhập/ Giá bán</label>
                        </div>
                        <div class="input-group col-lg-12 mb-3">
                            <span class="input-group-text"><i data-feather="clipboard"></i></span>
                            <input id="org_price" type="text" name="org_price" class="form-control"
                                placeholder="Giá  nhập" aria-label="Giá nhập" value="{{ $product->org_price }}">
                            <span class="input-group-text"><i data-feather="clipboard"></i></span>
                            <input id="sell_price" type="text" name="sell_price" class="form-control"
                                placeholder="Giá bán" aria-label="Giá bán" value="{{ $product->sell_price }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="qty" class="form-label">@lang('product::product.product.quantity')</label>
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="{{ @$product->qty }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="description" class="form-label">@lang('product::product.product.description')</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ @$product->description }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="product_content" class="form-label">@lang('product::product.product.content')</label>
                            <textarea name="product_content" id="product_content" cols="30" rows="5" class="form-control">{{ @$product->product_content }}</textarea>
                        </div>
                        <input type="text" id="featureCount" value="{{ $features->count() }}" hidden>
                        @foreach ($features as $index => $feature)
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">{{ $feature->name }}</label>
                                <select name="feature[]" id="feature-select_{{ $index }}">
                                    <option value="0">Không có dữ liệu</option>
                                    @foreach ($feature->children as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $product->features->contains('id', $item->id) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <div class="col-lg-12 mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <input type="text" class="form-control" id="priority" name="priority"
                                value="{{ @$product->priority }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="status-select" class="form-label">
                                @lang('product::product.product.status.header')
                            </label>
                            <select id="status-select" name="status" placeholder="Select your parent"
                                autocomplete="off">
                                <option value="A" {{ @$product->status == 'A' ? 'selected' : '' }}>
                                    @lang('product::product.product.status.A')
                                </option>
                                <option value="D" {{ @$product->status == 'D' ? 'selected' : '' }}>
                                    @lang('product::product.product.status.D')
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    Seo
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="seoTitle" class="form-label">Seo title</label>
                            <input type="text" class="form-control" id="seoTitle" name="seo_title"
                                value="{{ @$product->seo->seo_title }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="seoDescription" class="form-label">Seo Description</label>
                            <textarea type="text" cols="30" rows="5" class="form-control" id="seoDescription"
                                name="seo_description">{{ @$product->seo->seo_keyword }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="seoKeyword" class="form-label">Seo Keyword</label>
                            <textarea type="text" cols="30" rows="5" class="form-control" id="seoKeyword" name="seo_keyword">{{ @$product->seo->seo_description }}</textarea>
                        </div>
                        <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                            <button class="btn btn-success w-100 _effect--ripple waves-effect waves-light"
                                id="productSubmitForm">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
