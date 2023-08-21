@include('admin.layouts.header')

<!--begin::Wrapper-->
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    @include('admin.layouts.sidebar')
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        @include('sweetalert::alert')
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('admin.layouts.toolbar')
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                @if (Auth::user()->role_id == 1)
                @if (url()->full() == 'http://127.0.0.1:8000/admin/home')
                <div class="m-5 align-items-center">
                    {{ 'Hello '.auth()->user()->name .', Welcome on E-Commerce App' }}
                </div>
                @else
                @yield('content')
                @endif
                @else
                <center>
                    <h1 class="display-6">
                        {{ 'You Don\'t have access for this page.' }}
                    </h1>
                </center>
                @endif
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        @include('admin.layouts.footer')
