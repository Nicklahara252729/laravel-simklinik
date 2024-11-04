 <!--begin::Step 1-->
 <div data-kt-stepper-element="content">
     <div class="w-100 mt-10">
         <!--begin::Input group-->
         <div class="row g-9 mb-8">
             <!--begin::Col-->
             <div class="col-md-12 fv-row" id="reka-medis">
                 <!--begin::Label-->
                 <label class="required d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span>Nomor Rekam Medis</span>
                 </label>
                 <!--end::Label-->
                 <input type="text" class="form-control form-control-solid" placeholder="Masukan Nomor Reka Medis" name="no_rm" id="no_rm" required />
             </div>
             <!--end::Col-->
         </div>
         <!--end::Input group-->
         <div id="step-4">
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <!--begin::Label-->
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span class="required">Nama Pasien</span>
                     </label>
                     <!--end::Label-->
                     <input type="text" class="form-control form-control-solid" placeholder="Masukan Nama Pasien" id="nama_pasien" name="nama_pasien" required />
                     <span id="nama_pasien_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span class="required">Tanggal Lahir</span>
                     </label>
                     <input class="form-control form-control-solid" id="tgl_lahir" type="date" placeholder="Masukan Tanggal Lahir" name="tgl_lahir" />
                     <span id="tgl_lahir_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <!--begin::Label-->
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span class="required">No KTP</span>
                     </label>
                     <!--end::Label-->
                     <input type="text" class="form-control form-control-solid" id="no_ktp" name="no_ktp" minlength="16" maxlength="16" placeholder="Masukan No KTP" />
                     <span id="no_ktp_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <!--begin::Label-->
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span>Email</span>
                     </label>
                     <!--end::Label-->
                     <input type="email" class="form-control form-control-solid" placeholder="Masukan Email" id="email" name="email" />
                     <!-- <span id="email_message" class="text-danger"></span> -->
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <label class="required fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                     <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Jenis Kelamin" id="gender" name="gender" required>
                         <option></option>
                         <option value="laki - laki">Laki-Laki</option>
                         <option value="perempuan">Perempuan</option>
                     </select>
                     <span id="gender_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
                 <!--begin::Col-->
                 <div class="col-md-6 fv-row">
                     <!--begin::Label-->
                     <label class="required fs-6 fw-semibold form-label mb-2">Golongan Darah</label>
                     <!--end::Label-->
                     <select name="golongan_darah" class="form-select form-select-solid" data-placeholder="Pilih Golongan Darah" id="golongan_darah" data-control="select2">
                         <option></option>
                         <option value="a">A</option>
                         <option value="b">B</option>
                         <option value="o">O</option>
                         <option value="ab">AB</option>
                         <option value="tidak-tahu">Tidak Tahu</option>
                     </select>
                     <span id="golongan_darah_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                 <!--begin::Col-->
                 <div class="col-md-12 fv-row">
                     <!--begin::Label-->
                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span class="required">No Hp</span>
                     </label>
                     <!--end::Label-->
                     <input type="text" class="form-control form-control-solid" id="no_hp_1" minlength="13" maxlength="13" name="no_hp_1" placeholder="Masukan Nomor" />
                     <span id="no_hp_1_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
             <!--begin::Input group-->
             <div class="row g-9 mb-8">
                 <!--begin::Col-->
                 <div class="col-md-12 fv-row">
                     <!--begin::Label-->
                     <label class="required d-flex align-items-center fs-6 fw-semibold mb-2">
                         <span>Alamat</span>
                     </label>
                     <!--end::Label-->
                     <input type="text" class="form-control form-control-solid" placeholder="Masukan Alamat" id="alamat" name="alamat" required />
                     <span id="alamat_message" class="text-danger"></span>
                 </div>
                 <!--end::Col-->
             </div>
             <!--end::Input group-->
         </div>
     </div>
 </div>
 <!--end::Step 1-->