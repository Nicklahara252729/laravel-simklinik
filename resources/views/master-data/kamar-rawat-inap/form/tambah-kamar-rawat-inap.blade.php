<form id="form-kamar" class="form">
    <!--begin::Heading-->
    <div class="mb-13">
        <!--begin::Title-->
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <!--begin::Input group-->
    <div class="row g-9">
        <div class="col-md-12 fv-row mt-0">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Nama Kamar</span>
            </label>
            <input type="text" class="form-control form-control-solid" id="nama_kamar" name="nama_kamar" placeholder="Masukan Nama Kamar" />
        </div>
        <!--begin::Col-->
        <div class="col-md-6 fv-row bed-wrapper">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Jumlah Tempat Tidur</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" class="form-control form-control-solid" id="jumlah_bed" name="jumlah_bed" placeholder="Masukan Jumlah Tempat Tidur" />
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Harga Kamar</span>
            </label>
            <div class="input-group input-group-solid">
                <span class="input-group-text">Rp.</span>
                <input min="0" class="form-control form-control-solid"  inputmode="text" name="harga" id="harga_kamar" placeholder="Masukan harga Kamar" />
            </div>
        </div>
        <!--end::Col-->
    </div>
</form>