<form id="form-jadwal-poli" class="form">
    <div class="form-wrapper px-5 pb-5 pt-0">
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Poli</label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" name="uuid_poliklinik" id="poliklinik" data-control="select2" data-dropdown-parent="#modal-jadwal-poli" data-placeholder="Poliklinik">
                        <option></option>
                    </select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Dokter</label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" name="dokter" id="dokter" data-control="select2" data-hide-search="true" data-placeholder="Pilih Dokter">
                        <option></option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Perawat</label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" name="perawat" id="perawat" data-control="select2" data-hide-search="true" data-placeholder="Pilih Perawat">
                        <option></option>
                    </select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Hari</label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" name="hari" id="hari" data-control="select2" data-hide-search="true" data-placeholder="Pilih Hari">
                        <option></option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Jam</span>
                    </label>
                    <!--end::Label-->
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" class="form-control form-control-solid" id="start-hour" placeholder="Mulai jam" data-validator="start-hour" />
                        <span> - </span>
                        <input type="text" class="form-control form-control-solid" id="end-hour" placeholder="Sampai jam" data-validator="end-hour"/>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="kode_antrian">
                        <span>Kode Antrian</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" id="kode_antrian" name="kode_antrian" placeholder="Masukan Kode Antrian" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="keterangan">
                        <span>Ketarangan</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" id="keterangan" name="keterangan" placeholder="Masukan Keterangan" />
                </div>
                <!--end::Col-->
            </div>
    </div>
</form>