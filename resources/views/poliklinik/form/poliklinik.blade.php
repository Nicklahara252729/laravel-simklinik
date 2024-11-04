<form action="/api/web/poliklinik/store/perawat" id="perawat-action-form">
    <div class="row g-9 mb-8 perawat-input">
        <div class="">
            <div class="col-lg-12 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Tindakan (Perawat)</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih tindakan" data-control="select2" data-close-on-select="false" name="tindakan_perawat[]" id="tindakan-perawat" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
        </div>
    </div>
</form>

<form action="/api/web/poliklinik/store/dokter" id="dokter-action-form">
    
    <div class="mb-5">
        <hr>
    </div>

    <div class="row g-9 mb-8">
        <div class="">
            <div class="col-lg-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Tindakan (Dokter)</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih tindakan" data-control="select2" data-close-on-select="false" name="tindakan_dokter[]" id="tindakan-dokter" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
            <div class="col-lg-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Diagnosa</span>
                </label>
                <select class="form-select form-select-solid" data-placeholder="Pilih diagnosa" data-control="select2" data-close-on-select="false" name="diagnosa[]" id="diagnosa" multiple="multiple" data-dropdown-parent="#modal-detail">
                </select>
            </div>
            <div class="col-lg-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Resep</span>
                </label>
                <ol id="resep-container">
                    {{-- <li class="mb-4">
                        <div class="row mb-2">
                            <div class="col-lg-5">
                                <select class="form-select form-select-solid" data-placeholder="Pilih obat" data-control="select2" data-close-on-select="true" name="obat[]" data-dropdown-parent="#modal-detail">
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" class="form-control form-control-solid" name="jumlah[]" placeholder="Jumlah" min="1">
                            </div>
                            <div class="col-lg-3">
                                <input readonly class="form-control form-control-transparent" name="total[]" placeholder="total">
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-sm btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger delete-row-button" type="button">
                                    <i class="ki-outline ki-trash fs-1 p-0"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="keterangan[]" placeholder="keterangan" data-kt-autosize="true"></textarea>
                            </div>
                        </div>
                    </li> --}}
                    <div class="d-grid">
                        <button type="button" id="add-resep" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary mt-2">
                            {{-- Tambah Obat --}}
                            <i class="ki-outline ki-plus fs-2"></i>
                        </button>
                    </div>
                </ol>
            </div>
            <div class="col-lg-12 fv-row mb-5">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="">
                    <span class="required">Keterangan</span>
                </label>
                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="keterangan" placeholder="keterangan"></textarea>
            </div>
        </div>
    </div>

</form>

<div class="g-9 d-flex justify-content-end gap-3">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary" id="submit-tahap-selanjutnya">Simpan</button>
</div>