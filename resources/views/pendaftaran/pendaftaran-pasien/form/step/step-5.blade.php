<!--begin::Step 2-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100 mt-10">
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Nama Penanggung Jawab</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Masukan Nama Penanggung Jawab" id="nama_pj" name="nama_pj" required />
                <span id="nama_pj_message" class="text-danger"></span>

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">No Hp</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Masukan No Penanggung Jawab" id="no_hp" name="no_hp" required />
                <span id="no_hp_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Provinsi</label>
                <!--end::Label-->
                <select name="id_provinsi" id="provinsi" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Provinsi">
                    <option></option>
                </select>
                <span id="provinsi_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Kabupaten/Kota</label>
                <!--end::Label-->
                <select name="id_kabupaten" id="kabupaten" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kabupaten">
                    <option></option>
                </select>
                <span id="kabupaten_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <div class="row mb-8">
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Kecamatan</label>
                <!--end::Label-->
                <select name="id_kecamatan" id="kecamatan" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kecamatan">
                    <option></option>
                </select>
                <span id="kecamatan_message" class="text-danger"></span>
            </div>
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Desa/Kelurahan</label>
                <!--end::Label-->
                <select name="id_desa" id="desa" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Desa">
                    <option></option>
                </select>
                <span id="desa_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
        </div>
        <div class="row g-9 mb-10">
            <!--begin::Col-->
            <div class="col-md-12 fv-row">
                <!--begin::Label-->
                <label class="required d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span>Alamat</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Masukan Alamat" id="alamat_pj" name="alamat_pj" required />
                <span id="alamat_pj_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
        </div>

        <hr class="m-0" />

        <!--begin::Input group-->
        <div class="row g-9 mb-8 mt-1">
            <!--begin::Col-->
            <div class="col-md-6 fv-row" id="wrap-kunjungan">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Kunjungan</label>
                <!--end::Label-->
                <select name="kunjungan" id="kunjungan" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kunjungan">
                    <option></option>
                    <option value="sehat">Sehat</option>
                    <option value="sakit">Sakit</option>
                </select>
                <span id="kunjungan_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row" id="wrap-tujuan">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Tujuan</label>
                <!--end::Label-->
                <select name="uuid_poliklinik_link_klinik" id="poliklinik" class="form-select form-select-solid" data-control="select2">
                    <option></option>
                </select>
                <span id="poliklinik_message" class="text-danger"></span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <div class="row g-9 mb-8" id="wrap-ruangan">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="fs-6 fw-semibold form-label mb-2">Ruangan</label>
                <select name="uuid_kamar" id="select-ruangan" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Ruangan">
                    <option></option>
                </select>
            </div>
            <div class="col-md-6 fv-row">
                <label class="fs-6 fw-semibold form-label mb-2">Tempat Tidur</label>
                <select name="uuid_bed" id="select-bed" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Tempat Tidur">
                    <option></option>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Input group-->
        <div class="row g-9 mb-8" id="wrap-jenis-pembayaran">
            <div class="col-md-12 fv-row">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mb-2">Jenis Pembayaran</label>
                <select name="uuid_jp_link_faskes" id="jenis-pembayaran" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Jenis Pembayaran">
                    <option></option>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row" id="no_bpjs">
                <!--begin::Label-->
                <label class="fs-6 fw-semibold form-label mb-2">No BPJS</label>
                <input type="text" class="form-control form-control-solid" placeholder="Masukan No BPJS" name="no_bpjs" />
            </div>
            <!--end::Col-->
        </div>
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Step 2-->