@include('admin.header')

<!--begin::Wrapper-->
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    @include('admin.sidebar')
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        @include('sweetalert::alert')
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('admin.toolbar')
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                @if (Auth::user()->role_id == 1)
                    @yield('content')
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
        @include('admin.footer')
