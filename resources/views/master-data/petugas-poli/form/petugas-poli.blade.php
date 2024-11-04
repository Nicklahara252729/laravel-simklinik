<form id="form-petugas-poli" class="form">
    <!--begin::Card-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="user-input">
                <span class="required">Nama Pegawai</span>
            </label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Pegawai" name="uuid_user" id="user-input" data-dropdown-parent="#modal-petugas-poli" required>
                <option></option>
            </select>
        </div>
        <!--end::Col-->
    </div>

    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Poliklinik</span>
            </label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Poliklinik" name="uuid_poliklinik" id="poliklinik-input" data-dropdown-parent="#modal-petugas-poli" required>
                <option></option>
            </select>
        </div>
        <!--end::Col-->
    </div>
</form>