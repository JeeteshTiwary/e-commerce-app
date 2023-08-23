@extends('admin.layouts.home')
@section('title', 'Update Product Details')
@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Form-->
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
            action="{{ route('product.update', encrypt($product->id)) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!--begin::Aside column-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <!--begin::Thumbnail settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Thumbnail</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                            data-kt-image-input="true">
                            <!--begin::Preview existing thumbnail-->
                            <div class="image-input-wrapper w-150px h-150px"
                                style="background-image:url({{ asset('products/thumbnails') . '/' . $product->thumbnail }});">
                            </div>
                            <!--end::Preview existing thumbnail-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="thumbnail" value="{{ $product->thumbnail }}"
                                    accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="thumbnail_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel thumbnail">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image
                            files are accepted</div>
                        <!--end::Description-->
                        <span class="text-danger"> {{ $errors->first('thumbnail') }} </span>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Thumbnail settings-->
                <!--begin::Status-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Status</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                        </div>
                        <!--begin::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                            data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select" name="status">
                            <option></option>
                            <option value="1" {{ $product->productDetails->status == '1' ? 'selected' : null }}>
                                Published</option>
                            <option value="2" {{ $product->productDetails->status == '2' ? 'selected' : null }}>
                                Scheduled</option>
                            <option value="0" {{ $product->productDetails->status == '0' ? 'selected' : null }}>
                                Unpublished</option>
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the product status.</div>
                        <!--end::Description-->
                        <span class="text-danger"> {{ $errors->first('status') }} </span>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->
                <!--begin::Category & tags-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Product Details</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label">Brand</label>
                        <!--end::Label-->
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                            data-allow-clear="true" name="brand_id">
                            <option></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }} "
                                    @if (isset($product->brand[0]->id)) {{ $brand->id == $product->brand[0]->id ? 'selected' : null }}>{{ $brand->name }}
                                        @else
                                        {{ $brand->name }} @endif
                                    </option>
                            @endforeach
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7 mb-7">Add product to a brand.</div>
                        <!--end::Description-->
                        <!--end::Input group-->
                        <!--begin::Button-->
                        <a href="{{ route('brand.create') }}" class="btn btn-light-primary btn-sm mb-10">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                        rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                    <rect x="6" y="11" width="12" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Create new brand</a>
                        <!--end::Button-->
                        <div class="text-danger"> {{ $errors->first('brand_id') }} </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label">Categories</label>
                        <!--end::Label-->
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                            data-allow-clear="true" name="category_id">
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if (isset($product->category[0]->id)) {{ $category->id == $product->category[0]->id ? 'selected' : null }}>{{ $category->name }}
                                      @else
                                      {{ $category->name }} @endif
                                    </option>
                            @endforeach
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                        <!--end::Description-->
                        <!--end::Input group-->
                        <!--begin::Button-->
                        <a href="{{ route('category.create') }}" class="btn btn-light-primary btn-sm mb-10">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                        rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                    <rect x="6" y="11" width="12" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Create new category</a>
                        <!--end::Button-->
                        <div class="text-danger"> {{ $errors->first('category_id') }} </div>
                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label d-block">Tags</label>
                        <!--end::Label-->
                        {{-- <!--begin::Input-->
                        <input id="kt_ecommerce_add_product_tags" name="tags[]" class="form-control mb-2"
                            value="" />
                        <!--end::Input--> --}}
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                            data-allow-clear="true" name="tags[]" multiple="multiple">
                            <option></option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ $tag->id == $product->tags[0]->id ? 'selected' : null }}>{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Add tags to a product.</div>
                        <!--end::Description-->
                        <span class="text-danger"> {{ $errors->first('tags') }} </span>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category & tags-->
            </div>
            <!--end::Aside column-->
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_general">General</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_advanced">Advanced</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>General</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name" class="form-control mb-2"
                                            placeholder="Product name" value="{{ $product->name }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">A product name is required and recommended to be
                                            unique.</div>
                                        <!--end::Description-->
                                        <span class="text-danger"> {{ $errors->first('name') }} </span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div>
                                        <!--begin::Label-->
                                        <label class="form-label">Description</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <!-- <div id="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div> -->
                                        <textarea id="description" name="description" rows="4" cols="35">
                                    {{ $product->productDetails->description }}
                                    </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7" name="description">Set a description to the product
                                            for better
                                            visibility.</div>
                                        <!--end::Description-->
                                        <span class="text-danger"> {{ $errors->first('description') }} </span>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Media</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-2">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_ecommerce_add_product_media">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to
                                                        upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Upload up to 10
                                                        files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product media gallery.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Media-->
                            <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Pricing</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Base Price</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="base_price" class="form-control mb-2"
                                            placeholder="Product price"
                                            value="{{ $product->productDetails->base_price }}" />
                                        <!--end::Input-->
                                        <span class="text-danger"> {{ $errors->first('base_price') }} </span>
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the product base price.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Sale Price</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="sale_price" class="form-control mb-2"
                                            placeholder="Product price"
                                            value="{{ $product->productDetails->sale_price }}" />
                                        <!--end::Input-->
                                        <span class="text-danger"> {{ $errors->first('sale_price') }} </span>
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the product sale price.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                        <!--begin::Slider-->
                                        <div class="d-flex flex-column text-center mb-5">
                                            <div class="d-flex align-items-start justify-content-center mb-7">
                                                <span class="fw-bold fs-3x"
                                                    id="kt_ecommerce_add_product_discount_label">0</span>
                                                <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                            </div>
                                            <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm"></div>
                                        </div>
                                        <!--end::Slider-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Pricing-->
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Inventory-->
                            <!--begin::Inventory-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Inventory</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Quantity</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="d-flex gap-3">
                                            <input type="number" name="quantity_on_shelf" class="form-control mb-2"
                                                placeholder="Quantity on shelf"
                                                value="{{ $product->productDetails->quantity_on_shelf }}" />
                                            <span class="text-danger"> {{ $errors->first('quantity_on_shelf') }} </span>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <input type="number" name="quantity_in_warehouse" class="form-control mb-2"
                                                placeholder="Quantity in warehouse"
                                                value="{{ $product->productDetails->quantity_in_warehouse }}" />
                                            <span class="text-danger"> {{ $errors->first('quantity_in_warehouse') }}
                                            </span>
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product quantity.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Inventory-->
                            <!--end::Inventory-->
                            <!--begin::Variations-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Variations</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                        <!--begin::Label-->
                                        <label class="form-label">Add Product Variations</label>
                                        <!--end::Label-->
                                        <!--begin::Repeater-->
                                        <div id="kt_ecommerce_add_product_options">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="kt_ecommerce_add_product_options"
                                                    class="d-flex flex-column gap-3">
                                                    <div data-repeater-item=""
                                                        class="form-group d-flex flex-wrap align-items-center gap-5">
                                                        <!--begin::Select2-->
                                                        <div class="w-100 w-md-200px">
                                                            <select class="form-select" name="variation_id"
                                                                data-placeholder="Select a variation"
                                                                data-kt-ecommerce-catalog-add-product="product_option"
                                                                required>
                                                                <option></option>
                                                                @foreach ($variations as $variation)
                                                                    <option value="{{ $variation->id }}">
                                                                        {{ $variation->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!--end::Select2-->
                                                        <span class="text-danger"> {{ $errors->first('variation_id') }}
                                                        </span>
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control mw-100 w-200px"
                                                            name="variation_value" placeholder="Variation" required />
                                                        <!--end::Input-->
                                                        <span class="text-danger"> {{ $errors->first('variation_value') }}
                                                        </span>
                                                        <button type="button" data-repeater-delete=""
                                                            class="btn btn-sm btn-icon btn-light-danger">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="7.05025" y="15.5356"
                                                                        width="12" height="2" rx="1"
                                                                        transform="rotate(-45 7.05025 15.5356)"
                                                                        fill="currentColor" />
                                                                    <rect x="8.46447" y="7.05029" width="12"
                                                                        height="2" rx="1"
                                                                        transform="rotate(45 8.46447 7.05029)"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <button type="button" data-repeater-create=""
                                                    class="btn btn-sm btn-light-primary">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11" y="18"
                                                                width="12" height="2" rx="1"
                                                                transform="rotate(-90 11 18)" fill="currentColor" />
                                                            <rect x="6" y="11" width="12"
                                                                height="2" rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Add another variation</button>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Variations-->
                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <a href="{{ route('product.index') }}" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5">Cancel</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">Save Changes</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content container-->
@endsection
