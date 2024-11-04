<form id="form-faskes" class="form">
    <div class="p-4">
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row" id="logo-container">
                <input type="file" class="dropify" data-height="250" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="2M" name="logo" />
            </div>
        </div>
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-12 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Nama</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" id="nama-faskes" name="nama" placeholder="Masukan Nama" />
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Kode</span>
                </label>
                <input type="text" class="form-control form-control-solid" id="kode-faskes" name="kode" placeholder="Masukan Kode" />
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">No Faskes</span>
                </label>
                <input type="text" class="form-control form-control-solid" name="no_faskes" id="no-faskes" placeholder="Masukan No Faskes" />
            </div>
            <!--end::Col-->
        </div>


        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Kepala faskes</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih kepala faskes" name="uuid_user" id="user-input" data-dropdown-parent="#modal-faskes" required>
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
                <label class="required fs-6 fw-semibold form-label mb-2">Provinsi</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Provinsi" name="id_provinsi" id="provinsi">
                    <option></option>
                </select>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Kabupaten</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Kabupaten" name="id_kabupaten" id="kabupaten">
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
                <label class="required fs-6 fw-semibold form-label mb-2">Kecamatan</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Kecamatan" name="id_kecamatan" id="kecamatan">
                    <option></option>
                </select>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2">Desa</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Desa" name="id_desa" id="desa">
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
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Counter KK</span>
                </label>
                <input type="text" class="form-control form-control-solid" id="counter-kk" name="counter_kk" placeholder="Masukan Counter KK" />
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Counter Pasien</span>
                </label>
                <input type="text" class="form-control form-control-solid" name="counter_pasien" id="counter-pasien" placeholder="Masukan Counter Pasien" />
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <div class="row g-9 mb-8">
            <div class="col-md-12">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Map</span>
                </label>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Latitude</span>
                </label>
                <input type="text" class="form-control form-control-solid" id="latitude" name="latitude" placeholder="Masukan Latitude" />
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Longitude</span>
                </label>
                <input type="text" class="form-control form-control-solid" name="longitude" id="longitude" placeholder="Masukan Longtitude" />
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <label for="" class="form-label">Alamat</label>
                <input type="text" class="form-control form-control-solid" name="alamat" id="alamat" placeholder="Masukan Alamat" />
            </div>
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Kode Pos</span>
                </label>
                <input type="number" class="form-control form-control-solid" name="kode_pos" id="kode-pos" placeholder="Masukan Kode Pos" min="0"/>
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Col-->
        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Poliklinik</span>
                </label>
                <select class="form-select form-select-solid" data-close-on-select="false" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Poliklinik" data-allow-clear="true" multiple="multiple" data-filter="poliklinik" id="poliklinik_link" >
                </select>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Jenis Pembayaran</span>
                </label>
                <select class="form-select form-select-solid" data-close-on-select="false" data-control="select2" data-dropdown-parent="#modal-faskes"  data-placeholder="Pilih Jenis pembayaran" data-allow-clear="true" data-filter="jenis_pembayaran" multiple="multiple" id="jenis_pembayaran_link" >
                </select>
            </div>
        </div>
        <!--end::Col-->
        <!--end::Input group-->
    </div>
</form>