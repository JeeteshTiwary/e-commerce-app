@extends('admin.layouts.home')
@section('title', 'Add Category')
@section('content')
<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-xxl">
    <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/categories.html" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
                    <!--begin::Image input placeholder-->
                    <style>
                        .image-input-placeholder {
                            background-image: url({{ asset('admin/dist/assets/media/svg/files/blank-image.svg') }} );
                        }

                        [data-bs-theme="dark"] .image-input-placeholder {
                            background-image: url({{ asset('admin/dist/assets/media/svg/files/blank-image-dark.svg') }} );
                        }
                    </style>
                    <!--end::Image input placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                        <!--begin::Preview existing thumbnail-->
                        <div class="image-input-wrapper w-150px h-120px"></div>
                        <!--end::Preview existing thumbnail-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                            <!--begin::Icon-->
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--end::Icon-->
                            <!--begin::Inputs-->
                            <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" value="{{ old('thumbnail') }}" />
                            <input type="hidden" name="thumbnail_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-20px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel thumbnail">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-20px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image
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
                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status">
                        </div>
                    </div>
                    <!--begin::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select" name="status">
                        <option value=""></option>
                        <option value="1" selected="selected">Published</option>
                        <option value="2">Scheduled</option>
                        <option value="0">Unpublished</option>
                    </select>
                    <!--end::Select2-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the Brand status.</div>
                    <!--end::Description-->
                    <!--begin::Datepicker-->
                    <div class="d-none mt-10">
                        <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select publishing
                            date and time</label>
                        <input class="form-control" id="kt_ecommerce_add_category_status_datepicker" placeholder="Pick date & time" />
                    </div>
                    <!--end::Datepicker-->
                    <span class="text-danger"> {{ $errors->first('status') }} </span>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->
            <!--begin::Parent Category settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Parent Category</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select store Parent Category-->
                    <label for="kt_ecommerce_add_category_store_Parent Category" class="form-label">Select a parent
                        category</label>
                    <!--end::Select store Parent Category-->
                    <!--begin::Select2-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_store_Parent Category" name="parent_id">
                        <option></option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <option value="0"> none </option>
                    </select>
                    <!--end::Select2-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the parent category to the category (if any).</div>
                    <!--end::Description-->
                    <span class="text-danger"> {{ $errors->first('parent_category') }} </span>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Parent Category settings-->
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
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
                        <label class="required form-label">Category Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="name" class="form-control mb-2" placeholder="category name" value="{{ old('name') }}" />
                        <!--end::Input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">A category name is required.</div>
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
                        <div id="kt_ecommerce_add_category_description" name="kt_ecommerce_add_category_description" class="min-h-100px mb-2">
                            <textarea id="description" name="description" rows="4" cols="32">
                            {{ old('description') }}
                            </textarea>
                        </div>
                        <!--end::Editor-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a description to the category for better visibility.</div>
                        <!--end::Description-->
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('category.index') }}" id="kt_ecommerce_add_category_cancel" class="btn btn-light me-5">Cancel</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                    <span class="indicator-label">Save Changes</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
</div>
<!--end::Content container-->
@endsection
