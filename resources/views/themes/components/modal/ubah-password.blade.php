<div class="modal fade" tabindex="-1" id="modal-ubah-password" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0">
                <!--begin::Close-->
                <h3 class="modal-title">Ubah password</h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="" id="form-ubah-password">
                        <div class="row g-9 mb-5">
                            <div class="fv-row" data-kt-password-meter="true">
                                <label class="form-label fw-semibold fs-6 mb-2 required">
                                    Password lama
                                </label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="current_password" autocomplete="off" />
                                    <!--begin::Visibility toggle-->
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                        <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i>
                                    </span>
                                    <!--end::Visibility toggle-->
                                </div>
                            </div>
                        </div>

                        <div class="row g-9 mb-5">
                            <!--begin::Main wrapper-->
                            <div class="fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold fs-6 mb-2 required">
                                        Password baru
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="" name="password" autocomplete="off" />
                                        <!--begin::Visibility toggle-->
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span></i>
                                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
                                        </span>
                                        <!--end::Visibility toggle-->
                                    </div>
                                    <!--end::Input wrapper-->

                                    <!--begin::Highlight meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Highlight meter-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Hint-->
                                <div class="text-muted">
                                    Gunakan 8 karakter atau lebih dengan kombinasi huruf, angka & simbol.
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Main wrapper-->
                        </div>

                        <div class="row g-9 mb-5">
                            <div class="fv-row" data-kt-password-meter="true">
                                <label class="form-label fw-semibold fs-6 mb-2 required">
                                    Konfirmasi password
                                </label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="password_confirmation" autocomplete="off" />
                                    <!--begin::Visibility toggle-->
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                        <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i>
                                    </span>
                                    <!--end::Visibility toggle-->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit-ubah-password">Simpan perubahan</button>
            </div>
        </div>
    </div>
</div>
