<div class="card shadow w-700px" id="kartu-pasien" hidden>
   <div class="card-header px-6 py-4 bg-success align-items-center">
      <div class="col-lg-11">
         <h2 class="card-title text-center fs-1 fw-bold text-light" id="nama_puskesmas"></h2>
         <span class="text-light fw-semibold" id="phone"></span>
      </div>
      <div class="col-lg-1">
         <div class="img-wrapper">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Photo" width="50">
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-lg-9">
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">No RM</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="no_rm" name="no_rm"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">No KTP</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="no_ktp" name="no_ktp"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">Nama</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="nama_pasien" name="nama_pasien"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">Jenis Kelamin</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="gender" name="gender"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">Umur</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="umur" name="umur"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">Tanggal Lahir</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="tgl_lahir" name="tgl_lahir"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">Alamat</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="alamat" name="alamat"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-4 fw-semibold">No Hp</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="no_hp" name="no_hp"></span>
               </div>
            </div>
            <div class="row">
               <label class="col-lg-4 fw-semibold">Tanggal Daftar</label>
               <div class="col-lg-6">
                  <span class="fw-semibold fs-6 text-gray-800" id="tgl_daftar" name="tgl_daftar"></span>
               </div>
            </div>
         </div>
         <div class="col-lg-3 d-flex flex-column justify-content-center">
            <div class="row">
               <div class="col-12 mb-10">
                  <div class="img-wrapper d-flex justify-content-end">
                     <img src="{{asset('assets/images/avatars/300-1.jpg')}}" alt="Photo" id="foto" width="100">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12 mt-10">
                  <div class="img-wrapper d-flex justify-content-end">
                     <img src="{{asset('assets/images/qr-code/qr-code.png')}}" alt="Photo" width="150">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>