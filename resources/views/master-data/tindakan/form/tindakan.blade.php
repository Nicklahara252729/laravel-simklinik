<form id="form-tindakan" class="form">
    <!--begin::Card Tindakan-->
    <div class="card">
        <div class="card-body">
            <!--begin::Input group-->
            {{-- <input type="text" class="form-control form-control-solid" id="uuid_faskes" name="uuid_faskes" hidden /> --}}
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Kode</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" id="kode_tindakan" name="kode" placeholder="Masukan Kode" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Nama</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" id="nama_tindakan" name="nama" placeholder="Masukan Nama" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->

                <div class="col-md-6 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Harga Satuan</span>
                    </label>
                    <div class="input-group input-group-solid">
                        <span class="input-group-text">Rp.</span>
                        <input min="0" class="form-control form-control-solid" name="harga" id="harga-satuan_tindakan" inputmode="text" placeholder="Masukan harga satuan" />
                        {{-- <span class="input-group-text">.00</span> --}}
                    </div>

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Kategori</label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid" data-placeholder="Pilih Kategori" data-control="select2" name="uuid_tindakan_kategori" id="kategori_tindakan" data-dropdown-parent="#modal-tindakan">
                        <option></option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
    </div>
    <div class="card mt-7 mb-7">
        <div class="card-header border-0">
            <div class="card-title" id="title-tindakan-harga">
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-outline btn-outline-primary btn-active-light-primary" id="button-add-row-jenis-pembayaran-harga">
                        <i class="ki-outline ki-plus fs-2"></i>Tambah Harga
                    </button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <div class="card-body">
            <table class="table table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>No</th>
                        <th class="min-w-200px">Jenis Pembayaran</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 fw-semibold" id="container-row-jenis-pembayaran-harga">
                </tbody>
            </table>
        </div>
    </div>
</form>