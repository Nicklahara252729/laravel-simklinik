<div class="app-sidebar-menu flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
        <div class="p-6">
            <!--begin::User info-->
            <div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
                <div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
                    <img id="user-photo" src="{{asset('assets/images/avatars/blank.png')}}" alt="image" />
                </div>
                <!--begin::Name-->
                <div class="d-flex flex-column align-items-start justify-content-center ms-3">
                    <span class="text-gray-500 fs-8 fw-semibold">Hello <span class="" id="user-level">
                        <div class="menu-loader w-full py-2 px-10 ml-4 d-inline-block rounded-2"></div>    
                    </span></span>
                    <a href="#" id="user-name" class="text-gray-800 fs-7 fw-bold text-hover-primary">
                        <div class="menu-loader w-full py-3 px-10 ml-4 rounded-2"></div>    
                    </a>
                </div>
                <!--end::Name-->
            </div>
            <!--end::User info-->
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img id="user-photo-menu" alt="Logo" src="{{asset('assets/images/avatars/blank.png')}}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div id="user-name-menu" class="fw-bold d-flex align-items-center fs-5"></div>
                            <a href="javascript:void(0)" id="user-level-menu" class="fw-semibold text-muted text-hover-primary fs-7"></a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{ route('profil') }}" class="menu-link px-5">Profil</a>
                </div>
                <div class="menu-item px-5">
                    <a href="javascript:void(0)" class="menu-link px-5" type="button" data-bs-toggle="modal" data-bs-target="#modal-ubah-password">Ubah Password</a>
                </div>
                <!--end::Menu item-->
    
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
    
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a id="btn_sign_out" class="menu-link px-5">Sign Out</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
        </div>
        <div class="menu menu-column menu-rounded menu-sub-indention fw-bold px-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>
            <div class="menu-item mb-5">
                <a class="menu-link px-3 py-7 menu-loader" href="">
                </a>
            </div>

        </div>
    </div>
</div>