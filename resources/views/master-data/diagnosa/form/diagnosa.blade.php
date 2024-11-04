<form id="form-diagnosa" class="form">
    <!--begin::Card Tindakan-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="code">
                <span class="required">Kode</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="code" name="code" placeholder="Masukan kode ICD" />
        </div>
        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="diagnosa">
                <span class="required">Diagnosa</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="diagnosa" name="diagnosa" placeholder="Masukan nama Diagnosa" />
        </div>
        <!--end::Col-->
    </div>

    <!--begin::Card Tindakan-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="deskripsi">
                <span class="required">Deskripsi</span>
            </label>
            <textarea class="form-control form-control-solid" data-validator="deskripsi" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi" data-kt-autosize="true"></textarea>
        </div>
        <!--end::Col-->
    </div>

    {{-- <!--begin::Card Tindakan-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <div class="d-flex flex-stack notice rounded border-warning border border-dashed p-6">
                <!--begin::Label-->
                <div class="me-5 fw-semibold">
                    <label class="fs-6">Diagnosa Waring ?</label>
                    <div class="fs-7 text-muted">Jika kamu bigung, cek petunjung di pojok kanan atas halaman </div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-warning form-check-solid">
                    <input class="form-check-input" id="is-active-radio" value="1" type="checkbox"/>
                    <span class="form-check-label fw-semibold text-muted">Warning</span>
                </label>
                <!--end::Switch-->
            </div>
        </div>
        <!--end::Col-->
    </div> --}}

    {{-- <!--begin::Card Tindakan-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="dtd">
                <span class="required">Document Type Definition</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="dtd" name="dtd" placeholder="Masukan nama DTD" />
        </div>
        <!--end::Col-->
    </div> --}}
</form>