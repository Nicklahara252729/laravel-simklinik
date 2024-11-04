<div class="d-flex justify-content-end">
    <a id="open-create-modal" type="button" class="btn btn-primary mt-5" data-bs-toggle="modal"
        data-bs-target="#modal-jadwal-poli">
        <i class="ki-outline ki-plus fs-2"></i>Tambah Jadwal
    </a>
</div>

<div class="row">
    <div class="col-2">
        <ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 min-w-lg-200px">
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 active btn btn-flex btn-active-light-primary" data-bs-toggle="tab"
                    href="#senin">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Senin</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#selasa">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Selasa</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#rabu">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Rabu</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#kamis">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Kamis</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#jumat">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Jumat</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#sabtu">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Sabtu</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
            <li class="nav-item w-100 me-0 mb-md-2">
                <a class="nav-link w-100 btn btn-flex btn-active-light-primary" data-bs-toggle="tab" href="#minggu">
                    <span class="svg-icon fs-2"><svg>...</svg></span>
                    <span class="d-flex flex-column align-items-start">
                        <span class="fs-4 fw-bold">Minggu</span>
                        {{-- <span class="fs-7">Description</span> --}}
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-10">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="senin" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Minggu</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-minggu">
                        <!--Minggu-->
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>

                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="selasa" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-senin">
                        <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                            <h2 class="m-0 text-light">Senin</h2>
                        </div>
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="rabu" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Selasa</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-selasa">
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="kamis" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Rabu</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-rabu">
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="jumat" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Kamis</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-kamis">
                        <!--Minggu-->
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="sabtu" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Jumat</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-jumat">
                        <!--Minggu-->
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </section>
                <!--end::Table-->
            </div>
            <div class="tab-pane fade" id="minggu" role="tabpanel">
                <!--begin::Table-->
                <section class="mb-5 pb-10 pt-10">
                    <div class="d-flex justify-content-start w-100 bg-primary align-items-center p-5 rounded">
                        <h2 class="m-0 text-light">Sabtu</h2>
                    </div>
                    <table class="table align-middle table-row-bordered fs-6 gy-5" id="table-jadwal-poli-sabtu">
                        <!--Minggu-->
                        <thead>
                            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>No</th>
                                <th>Poliklinik</th>
                                <th>Dokter</th>
                                <th>Jam</th>
                                <th>Kode Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>

                    </table>
                </section>
                <!--end::Table-->
            </div>
        </div>
    </div>
</div>
