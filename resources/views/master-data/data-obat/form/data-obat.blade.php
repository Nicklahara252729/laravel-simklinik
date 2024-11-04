<form id="form-data-obat" class="form">
    <!--begin::Card master obat-->
    <div class="mb-8">
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="kode">
                    <span class="required">Kode</span>
                </label>
                <input type="text" class="form-control form-control-solid" id="kode" name="kode" placeholder="Masukan kode" />
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="nama">
                    <span class="required">Nama</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" id="nama" name="nama" placeholder="Masukan nama" />
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="harga">
                    <span class="required">Harga Satuan</span>
                </label>
                <div class="input-group input-group-solid">
                    <span class="input-group-text" id="harga-satuan">Rp.</span>
                    <input min="0" inputmode="text" class="form-control" name="harga_satuan" placeholder="Masukkan harga satuan" aria-label="Masukkan harga satuan" aria-describedby="harga-satuan"/>
                </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="harga">
                    <span class="required">Harga Beli</span>
                </label>
                <div class="input-group input-group-solid">
                    <span class="input-group-text" id="harga-bel">Rp.</span>
                    <input min="0" inputmode="text" class="form-control" name="harga_beli" placeholder="Masukkan harga beli" aria-label="Masukkan harga beli" aria-describedby="harga-bel"/>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-4 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2" for="uuid-satuan-obat">Satuan Obat</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-data-obat" data-placeholder="Pilih satuan obat" name="uuid_satuan_obat" id="uuid-satuan-obat">
                    <option></option>
                </select>
            </div>
            <div class="col-md-4 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2" for="uuid-klasifikasi-obat">Klasifikasi Obat</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-data-obat" data-placeholder="Pilih klasifikasi obat" name="uuid_klasifikasi_obat" id="uuid-klasifikasi-obat">
                    <option></option>
                </select>
            </div>
            <div class="col-md-4 fv-row">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold form-label mb-2" for="jenis">Jenis</label>
                <!--end::Label-->
                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal-data-obat" data-hide-search="true" data-placeholder="Pilih jenis" name="jenis" id="jenis">
                    <option></option>
                    <option value="bnp">BNP</option>
                    <option value="obat injeksi">Obat Injeksi</option>
                    <option value="reagent">Reagent</option>
                    <option value="vaksin">Vaksin</option>
                    <option value="imunisasi">Imunisasi</option>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="tgl-expired">
                    <span class="required">Tanggal Expired</span>
                </label>
                <div class="position-relative d-flex align-items-center">
                    <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                    <input type="text" class="form-control form-control-solid ps-12 flatpickr" id="tgl-expired" name="tgl_expired" placeholder="Masukan tanggal expired" />
                </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="no-batch">
                    <span class="required">No Batch</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" id="no-batch" name="no_batch" placeholder="Masukan nomor batch" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row g-9 mb-8">
            <div class="col-md-12 fv-row">
                <div class="d-flex flex-stack">
                    <!--begin::Label-->
                    <div class="me-5 fw-semibold">
                        <label class="fs-6">Aktifkan obat ini ?</label>
                        <div class="fs-7 text-muted">Jika kamu bigung, cek petunjung di pojok kanan atas halaman </div>
                    </div>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" id="is-active-radio" type="checkbox" checked="checked" disabled/>
                        <span class="form-check-label fw-semibold text-muted">Aktif</span>
                    </label>
                    <!--end::Switch-->
                </div>
            </div>
        </div>

        <div class="col-md-12 fv-row">
            <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6">
                <!--begin::Icon-->
                <i class="ki-duotone ki-setting-3 fs-4x text-info me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-semibold">
                        <h5 class="text-gray-900 fw-bold">Eits !</h5>
                        <div class="fs-7 text-gray-700">Untuk mengubah status obat, silahkan kunjungi
                        <a href="#">Pengaturan Grup</a></div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
        </div>
    </div>
    <div class="card mt-7 mb-7">
        <div class="card-header border-0">
            <div class="card-title" id="title-harga">
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