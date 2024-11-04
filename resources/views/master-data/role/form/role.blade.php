<form id="form-role" class="form">
    <!--begin::Card-->
    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-4 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="nama-menu">
                <span class="required">Nama Menu</span>
            </label>
            <input type="text" id="nama-menu" class="form-control form-control-solid" placeholder="Masukkan Nama Menu" name="menu" aria-label="Username" aria-describedby="nama-menu" />
        </div>
        <!--end::Col-->
        <div class="col-md-8 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="link">
                <span class="required">Link</span>
            </label>
            <div class="input-group input-group-solid">
                <span class="input-group-text" id="link">{{ url('/') }}/</span>
                <input type="text" class="form-control" placeholder="Masukkan link" name="link" aria-label="Username" aria-describedby="link" />
            </div>
        </div>
    </div>

    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="icon">
                <span class="">Icon</span>
            </label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih icon" name="icon" id="icon" data-dropdown-parent="#modal-role" required>
                <option></option>
            </select>
        </div>
        <div class="col-md-6 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="">Parent Menu</span>
            </label>
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih parents menu" name="parent" id="parent" data-dropdown-parent="#modal-role" required>
                <option></option>
            </select>
        </div>
        <!--end::Col-->
    </div>

    <div class="row g-9 mb-8">
        <!--begin::Col-->
        <!--end::Col-->
    </div>

    <div class="row g-9 mb-8">
        <div class="col-md-12 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Role access</span>
            </label>
            <div class="row">
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-dark">
                                        <i class="ki-outline ki-briefcase fs-1 text-dark"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-dark">Admin Dinas</span>
                                    <span class="fs-7 text-muted">Administrator Organisasi Dengan Tanggung Jawab Manajemen Efisien.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="admin_dinas">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="ki-outline ki-keyboard fs-1 text-warning"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-warning">Admin Faskes</span>
                                    <span class="fs-7 text-muted">Administrator Fasilitas Kesehatan dengan Pengelolaan dan Pengawasan Efektif.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="admin_faskes">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-outline ki-monitor-mobile fs-1 text-primary"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-primary">Operator</span>
                                    <span class="fs-7 text-muted">Pengelola Tugas Harian dengan Tanggung Jawab Spesifik</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="operator">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-outline ki-abstract-10 fs-1 text-danger"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-danger">Dokter</span>
                                    <span class="fs-7 text-muted">Pelayan Kesehatan Ahli dengan Diagnosa dan Pengobatan Komprehensif</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="dokter">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-success">
                                        <i class="ki-outline ki-mask fs-1 text-success"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-success">Staff</span>
                                    <span class="fs-7 text-muted">Tenaga Pendukung dengan Tugas Administratif dan Dukungan Operasional.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="staff">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-outline ki-bandage fs-1 text-primary"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-primary">Pasien</span>
                                    <span class="fs-7 text-muted">Individu Menerima Perawatan Medis dan Kesehatan Profesional.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="pasien">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-dark">
                                        <i class="ki-outline ki-bandage fs-1 text-dark"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-dark">Resepsionis</span>
                                    <span class="fs-7 text-muted">Menerima dan Mengatur Kunjungan Pasien.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="resepsionis">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-outline ki-bandage fs-1 text-info"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-info">Apoteker</span>
                                    <span class="fs-7 text-muted">Menyediakan Informasi Obat dan Konsultasi Kesehatan.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="apoteker">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="ki-outline ki-bandage fs-1 text-warning"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-warning">Kasir</span>
                                    <span class="fs-7 text-muted">Mengurus Transaksi Pembayaran Layanan Medis.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="kasir">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
                <div class="col-md-6 d-flex border-gray-200 border-dashed rounded-2">
                    <label class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <div class="me-5">
                            <span class="d-flex align-items-center me-2">
                                <!--begin:Icon-->
                                <span class="symbol symbol-50px me-4">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-outline ki-bandage fs-1 text-danger"></i>
                                    </span>
                                </span>
                                <!--end:Icon-->
                                <!--begin:Info-->
                                <span class="d-flex flex-column">
                                    <span class="fw-semibold fs-6 text-danger">Perawat</span>
                                    <span class="fs-7 text-muted"> Memberikan Perawatan Medis dan Bantuan Pasien.</span>
                                </span>
                                <!--end:Info-->
                            </span>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" name="perawat">
                            <span class="form-check-label fw-semibold text-muted">Izinkan</span>
                        </div>
                        <!--end::Switch-->
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>