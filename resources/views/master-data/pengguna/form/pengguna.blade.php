<form id="form-pengguna" class="form" enctype="multipart/form-data">
    <div class="row mb-6">
        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Photo</span>
            </label>
            <input type="file" class="dropify" data-height="200" data-allowed-file-extensions="jpg jpeg png webp"
                data-max-file-size="2M" name="photo"/>
        </div>
        <!--end::Image input-->
    </div>
    <div class="row g-9 mb-8">

        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="name">
                <span class="required">Nama</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="name" name="name"
                placeholder="Masukan Nama" />
        </div>


        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="email">
                <span class="required">Email</span>
            </label>

            <input type="email" class="form-control form-control-solid" id="email" name="email"
                placeholder="Masukan Email" />
        </div>

    </div>
    <!--end::Input group-->
    <div class="row g-9 mb-8">

        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="username">
                <span class="required">Username</span>
            </label>
            <input type="text" class="form-control form-control-solid" name="username" id="username"
                placeholder="Masukan Username" />
        </div>
    </div>


    <div class="row g-9 mb-8" id="password-input-container">
        <div class="fv-row col-md-12" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2">
                    Password
                </label>
                <!--end::Label-->
        
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-solid"
                        type="password" placeholder="" name="password" id="password" autocomplete="off" />
        
                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>
                <!--end::Highlight meter-->
            </div>
            <!--end::Wrapper-->
        </div>
        <div class="fv-row col-md-12" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2">
                    Konfirmasi Password
                </label>
                <!--end::Label-->
        
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-solid"
                        type="password" placeholder="" name="confirm_password" id="confirm_password" autocomplete="off" />
        
                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>
                <!--end::Highlight meter-->
            </div>
            <!--end::Wrapper-->
        </div>
    </div>

    <div class="row g-9 mb-8">
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="phone">
                <span class="required">phone</span>
            </label>
            <input type="text" pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                name="phone" id="phone" placeholder="Masukan nomor hp" />
        </div>
    </div>


</form>
