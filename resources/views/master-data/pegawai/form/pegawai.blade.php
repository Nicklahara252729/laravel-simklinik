<form id="form-pegawai" class="form" enctype="multipart/form-data">
    <div class="row g-9 mb-8">

        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="name">
                <span class="required">Nama</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="name" name="name"
                placeholder="Masukan Nama" />
        </div>


        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="email">
                <span class="required">Email</span>
            </label>

            <input type="email" class="form-control form-control-solid" id="email" name="email"
                placeholder="Masukan Email" />
        </div>

        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="username">
                <span class="required">Username</span>
            </label>
            <input type="text" class="form-control form-control-solid" name="username" id="username"
                placeholder="Masukan Username" />
        </div>
    </div>

    <div class="row g-9 mb-8" id="password-input-container">
        <div class="fv-row col-md-6" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2">
                    Password
                </label>
        
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-solid"
                        type="password" placeholder="Masukkan password" name="password" id="password" autocomplete="off" />
        
                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>
            </div>
        </div>
        <div class="fv-row  col-md-6" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2">
                    Konfirmasi password
                </label>
        
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-solid"
                        type="password" placeholder="Konfirmasi password" name="confirm_password" autocomplete="off" />
        
                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="password">
                <span class="required">Password</span>
            </label>
            <input type="password" class="form-control form-control-solid" name="password" id="password"
                placeholder="Masukan Password" />
        </div>

        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="confirm-password">
                <span class="required">Confirm password</span>
            </label>
            <input type="password" class="form-control form-control-solid" name="confirm_password" id="confirm-password"
                placeholder="Masukan Password" />
        </div> --}}
        
    </div>
    
    
    <div class="row g-9 mb-8">
        <div class="col-md-12 fv-row">
            <label class="required fs-6 fw-semibold form-label mb-2" for="level">Level</label>
    
            <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-pegawai" data-hide-search="true"  id="level" data-placeholder="Pilih Level" name="level">
                <option></option>
                <option value="operator">Operator</option>
                <option value="dokter">Dokter</option>
                <option value="staff">Staff</option>
                <option value="pasien">Pasien</option>
                <option value="resepsionis">Resepsionis</option>
                <option value="apoteker">Apoteker</option>
                <option value="kasir">Kasir</option>
                <option value="perawat">Perawat</option>
            </select>
        </div>
    </div>



    <div class="perawat-container d-none">
        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Ruangan</span>
                </label>
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-pegawai"  data-placeholder="Pilih akses ruangan" name="uuid_role" id="role">
                    <option value=""></option>
                </select>
            </div>
        </div>
    
        <div class="row g-9 mb-8 poli-access perawat-input">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Poli</span>
                </label>
                <select class="form-select form-select-solid" data-fitler="poli" data-close-on-select="false" data-control="select2" data-dropdown-parent="#modal-pegawai"  data-placeholder="Pilih akses poli" data-allow-clear="true" multiple="multiple" id="poli-access" >
                </select>
            </div>
        </div>
    
        <div class="row g-9 mb-8 kamar-access  perawat-input">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Kamar</span>
                </label>
                <select class="form-select form-select-solid" data-fitler="kamar" data-close-on-select="false" data-control="select2" data-dropdown-parent="#modal-pegawai"  data-placeholder="Pilih akses kamar" data-allow-clear="true" multiple="multiple" id="kamar-access" >
                </select>
            </div>
        </div>
    </div>

    <div class="row g-9 mb-8 dokter-container d-none">
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Spesialis</span>
            </label>
            <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-pegawai" name="uuid_spesialis"  data-placeholder="Pilih spesialis" id="spesialis" >
                <option value=""></option>
            </select>
        </div>
    </div>

    <div class="row g-9 mb-8">

    </div>

    <div class="row g-9 mb-8">
        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="phone">
                <span class="required">phone</span>
            </label>
            <input  pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                name="phone" id="phone" placeholder="Masukan nomor hp" />
        </div>
        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-ktp">
                <span class="required">Nomor KTP</span>
            </label>
            <input  pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                id="no-ktp" name="no_ktp" placeholder="Masukan nomor KTP" />
        </div>


        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-npwp">
                <span class="required">Nomor NPWP</span>
            </label>

            <input pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                id="no-npwp" name="no_npwp" placeholder="Masukan no NPWP" />
        </div>
    </div>
    <!--end::Input group-->

    <div class="row g-9 mb-8">
        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-str">
                <span class="required">Nomor STR</span>
            </label>

            <input pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                id="no-str" name="no_str" placeholder="Masukan no STR" />
        </div>

        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="tgl-berlaku-str">
                <span class="required">Tanggal berlaku STR</span>
            </label>
            <div class="position-relative d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                <input class="form-control form-control-solid ps-12 flatpickr" id="tgl-berlaku-str" name="tgl_berlaku_str"
                    placeholder="Piih tanggal berlaku str" />
            </div>
        </div>


        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="tgl-berakhir-str">
                <span class="required">Tanggal berakhir STR</span>
            </label>

            <div class="position-relative d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                <input class="form-control form-control-solid ps-12 flatpickr" id="tgl-berakhir-str" name="tgl_berakhir_str"
                    placeholder="Piih tanggal berakhir str" />
            </div>
        </div>

    </div>

    <div class="row g-9 mb-8">

        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-sip">
                <span class="">Nomor SIP</span>
            </label>

            <input type="text" pattern="[0-9]*" inputmode="numeric" class="form-control form-control-solid"
                id="no-sip" name="no_sip" placeholder="Masukan no SIP" />
        </div>

        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="tgl-berlaku-sip">
                <span class="">Tanggal berlaku SIP</span>
            </label>
            <div class="position-relative d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                <input class="form-control form-control-solid ps-12 flatpickr" id="tgl-berlaku-sip" name="tgl_berlaku_sip"
                    placeholder="Piih tanggal berlaku sip" />
            </div>
        </div>


        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="tgl-berakhir-sip">
                <span class="">Tanggal berakhir SIP</span>
            </label>

            <div class="position-relative d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                <input class="form-control form-control-solid ps-12 flatpickr" id="tgl-berakhir-sip" name="tgl_berakhir_sip"
                    placeholder="Piih tanggal berakhir sip" />
            </div>
        </div>
    </div>


    <div class="row g-9 mb-8">
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-sip">
                <span class="required">Alamat</span>
            </label>
            <textarea name="alamat" id="alamat" class="form-control form-control form-control-solid" data-kt-autosize="true"></textarea>
        </div>
    </div>

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

</form>
