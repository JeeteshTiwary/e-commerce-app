         <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="225px" data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
             <!--begin::Logo-->
             <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                 <!--begin::Logo image-->
                 <a href="javascript:void(0)">
                     <img alt="Logo" src="{{ asset('admin/dist/assets/media/logos/e-commerce-app-logo.jpg') }}"
                         class="h-25px app-sidebar-logo-default" />
                         E-Commerce App
                     <img alt="Logo" src="{{ asset('admin/dist/assets/media/logos/e-commerce-app-logo.jpg') }}" class="h-20px app-sidebar-logo-minimize">
                 </a>
                 <!--end::Logo image-->
                 <!--begin::Sidebar toggle-->
                 <div id="kt_app_sidebar_toggle"
                     class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                     data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                     data-kt-toggle-name="app-sidebar-minimize">
                     <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                     <span class="svg-icon svg-icon-2 rotate-180">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path opacity="0.5"
                                 d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                 fill="currentColor" />
                             <path
                                 d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                 fill="currentColor" />
                         </svg>
                     </span>
                     <!--end::Svg Icon-->
                 </div>
                 <!--end::Sidebar toggle-->
             </div>
             <!--end::Logo-->
             <!--begin::sidebar menu-->
             <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                 <!--begin::Menu wrapper-->
                 <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
                     data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                     data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                     data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                     data-kt-scroll-save-state="true">
                     <!--begin::Menu-->
                     <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                         data-kt-menu="true" data-kt-menu-expand="false">
                         <!--begin:Menu item-->
                         <div class="menu-item pt-5">
                             <!--begin:Menu content-->
                             <div class="menu-content">
                                 <span class="menu-heading fw-bold text-uppercase fs-7">Actions</span>
                             </div>
                             <!--end:Menu content-->
                         </div>
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                             <!--begin:Menu link-->
                             {{-- <span class="menu-link">
                                 <span class="menu-icon">
                                     <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                     <span class="svg-icon svg-icon-2">
                                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                             <path
                                                 d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                                 fill="currentColor" />
                                             <path opacity="0.3"
                                                 d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                                 fill="currentColor" />
                                             <path opacity="0.3"
                                                 d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                                 fill="currentColor" />
                                         </svg>
                                     </span>
                                     <!--end::Svg Icon-->
                                 </span>
                                 <span class="menu-title">Brands</span>
                                 <span class="menu-arrow"></span>
                             </span> --}}
                             <!--end:Menu link-->
                             <!--begin:Menu sub-->
                             {{-- <div class="menu-sub menu-sub-accordion"> --}}
                             <!--begin:Menu item-->
                             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                 <!--begin:Menu sub-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link" href="{{ route('brand.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Brands</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link" href="{{ route('category.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Categories</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link" href="{{ route('product.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Products</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link" href="{{ route('customer.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Customers</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                                 <!--begin:Menu item-->
                                 <div class="menu-item">
                                     <!--begin:Menu link-->
                                     <a class="menu-link" href="{{ route('order.index') }}">
                                         <span class="menu-bullet">
                                             <span class="bullet bullet-dot"></span>
                                         </span>
                                         <span class="menu-title">Orders</span>
                                     </a>
                                     <!--end:Menu link-->
                                 </div>
                                 <!--end:Menu item-->
                                 <!--end:Menu sub-->
                             </div>
                             <!--end:Menu item-->
                             <!--end:Menu sub-->
                         </div>
                         <!--end:Menu item-->
                     </div>
                     <!--end::Menu-->
                 </div>
                 <!--end::Menu wrapper-->
             </div>
             <!--end::sidebar menu-->
         </div>
