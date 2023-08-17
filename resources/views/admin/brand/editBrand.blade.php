@extends('admin.layouts.home')
@section('title', 'Update Brand details')

@section('content')
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_Brand_form" class="form d-flex flex-column flex-lg-row"
            action="{{ route('brand.update', encrypt($brand->id)) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!--begin::Aside column-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <!--begin::Logo settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Logo</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                            data-kt-image-input="true">
                            <!--begin::Preview existing logo-->
                            <div class="image-input-wrapper w-150px h-150px"
                                style="background-image:url({{ asset('brands/logos') . '/' . $brand->logo }});"></div>
                            <!--end::Preview existing logo-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change logo">
                                <!--begin::Icon-->
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--end::Icon-->
                                <!--begin::Inputs-->
                                <input type="file" name="logo" value="{{ $brand->logo }}"
                                    accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="logo_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel logo">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove logo">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the Brand Logo image. Only *.png, *.jpg and *.jpeg
                            image files are accepted</div>
                        <!--end::Description-->
                        <span class="text-danger"> {{ $errors->first('logo') }} </span>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Logo settings-->
                <input type="hidden" name="updateId" value="{{ encrypt($brand->id) }}" />
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
                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_Brand_status">
                            </div>
                        </div>
                        <!--begin::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                            data-placeholder="Select an option" id="kt_ecommerce_add_Brand_status_select" name="status">
                            <option></option>
                            <option value="1" {{ $brand->status == '1' ? 'selected' : null }}>Published</option>
                            <option value="2" {{ $brand->status == '2' ? 'selected' : null }}>Scheduled</option>
                            <option value="0" {{ $brand->status == '0' ? 'selected' : null }}>Unpublished</option>
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the Brand status.</div>
                        <!--end::Description-->
                        <!--begin::Datepicker-->
                        <div class="d-none mt-10">
                            <label for="kt_ecommerce_add_Brand_status_datepicker" class="form-label">Select
                                publishing date and time</label>
                            <input class="form-control" id="kt_ecommerce_add_Brand_status_datepicker"
                                placeholder="Pick date & time" />
                        </div>
                        <!--end::Datepicker-->
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
                            <h2>Associated categories </h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label">Categories</label>
                        <!--end::Label-->
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                            data-allow-clear="true" multiple="multiple" name="categories[]">
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $brand->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7 mb-7">Add categories to a brand.</div>
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
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category & tags-->
            </div>
            <!--end::Aside column-->
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Brand Details</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Brand Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control mb-2" placeholder="Brand name"
                                value="{{ $brand->name }}" />
                            <!--end::Input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">A Brand name is required and recommended to be unique.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div>
                            <!--begin::Label-->
                            <label class="form-label">Description</label>
                            <!--end::Label-->
                            <!--begin::Editor-->
                            <div id="kt_ecommerce_add_Brand_description" name="kt_ecommerce_add_Brand_description"
                                class="min-h-100px mb-2">
                                <textarea id="description" name="description" rows="4" cols="50">{{ $brand->description }}. </textarea>
                            </div>
                            <!--end::Editor-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set a description to the Brand for better visibility.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div>
                            <!--begin::Label-->
                            <label class="required form-label">Url</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="url" name="url" class="form-control mb-2" placeholder="brand url"
                                value="{{ $brand->url }}" />
                            <!--end::Input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">A brand url is the url of the website of the
                                corresponding brand.
                            </div>
                            <!--end::Description-->
                        </div>
                        <span class="text-danger"> {{ $errors->first('url') }} </span>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::General options-->
                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <a href="{{ route('brand.index') }}" id="kt_ecommerce_add_Brand_cancel"
                        class="btn btn-light me-5">Cancel</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_Brand_submit" class="btn btn-primary">
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
