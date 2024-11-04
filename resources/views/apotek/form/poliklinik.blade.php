<form action="" id="form-tahap-selanjutnya">
    <div class="row g-9 mb-8 perawat-input">
        <div class="">
            <div class="col-md-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Tindakan (Perawat)</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih tindakan" data-control="select2" data-close-on-select="false" name="tindakan_perawat" id="tindakan-perawat" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
        </div>
    </div>

    <div class="row g-9 mb-8 dokter-input">
        <div class="">
            <div class="col-md-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Tindakan (Dokter)</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih tindakan" data-control="select2" data-close-on-select="false" name="tindakan_dokter" id="tindakan-dokter" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
            <div class="col-md-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Diagnosa</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih diagnosa" data-control="select2" data-close-on-select="false" name="diagnosa" id="diagnosa" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
            <div class="col-md-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Resep</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih resep" data-control="select2" data-close-on-select="false" name="resep" id="resep" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
            <div class="col-md-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Keterangan</span>
                </label>
                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="keterangan"></textarea>
            </div>
            
        </div>
    </div>

    <div class="g-9 d-flex justify-content-end gap-3">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="submit-tahap-selanjutnya">Simpan</button>
    </div>
</form>