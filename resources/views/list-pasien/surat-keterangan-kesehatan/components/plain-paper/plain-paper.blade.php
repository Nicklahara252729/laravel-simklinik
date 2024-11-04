<div class="container" id="surat-keterangan" hidden>
   <header>
      <div class="d-flex justify-content-between">
         <div class="logo-provinsi">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Photo" width="60">
         </div>
         <div class="title">
            <h1 class="text-center" id="nama_faskes" name="nama_faskes"></h1>
            <p class="text-center fs-4" id="alamat_faskes" name="alamat_faskes"></p>
         </div>
         <div class="logo-puskesmas">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Photo" width="60">
         </div>
      </div>
   </header>
   <hr />
   <main>
      <div class="wrapper my-10">
         <div class="main-title mb-3 text-center">
            <h1>Surat Keterangan Kesehatan</h1>
            <span class="fw-semibold fs-4">Nomor</span>
            <span id="no_surat" class="fw-semibold fs-4"></span>
         </div>

         <span class="fs-4">Yang bertanda tangan dibawah ini. Dokter Umum Pada Puskesmas Melati Kecamatan Binjai Barat menerangkan bahwa :</span>

         <div class="bio-data my-10">
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">Nama</label>
               <div class="col-lg-9">
                  <span class="fw-semibold fs-4 text-gray-800" id="nama_pasien" name="nama_pasien"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">Tempat/Tgl.Lahir</label>
               <div class="col-lg-9">
                  <span class="fw-semibold fs-4 text-gray-800" id="tgl_lahir" name="tgl_lahir"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">Jenis Kelamin</label>
               <div class="col-lg-9">
                  <span class="fw-semibold fs-4 text-gray-800" id="gender" name="gender"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">No Telephone</label>
               <div class="col-lg-9">
                  <span class="fw-semibold fs-4 text-gray-800" id="no_hp" name="no_hp"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">No RM</label>
               <div class="col-lg-9">
                  <span class="fw-semibold fs-4 text-gray-800" id="no_rm" name="no_rm"></span>
               </div>
            </div>
            <div class="row mb-5">
               <label class="col-lg-3 fw-semibold fs-4">Alamat</label>
               <div class="col-lg-9">
                  <span class=" fw-semibold fs-4 text-gray-800" id="alamat" name="alamat"></span>
               </div>
            </div>
         </div>

         <div class="mb-4">
            <span class="fs-4">Dalam pemeriksaan kami pada saat ini yang bersangkutan dalam keadaan :</span> <span class="fs-2 text-uppercase fw-bold">Sehat / Tidak Sehat</span>
         </div>
         <div class="mb-4">
            <span class="fs-4">Surat Keterangan ini digunakan untuk :</span> <span class="fs-2 fw-bold">Persyaratan Mengikuti Tes Akmil</span>
         </div>
         <div class="mb-4">
            <span class="fs-4">Demikian surat ini dibuat untuk dapat dipergunakan sebagai mana mestinya.</span>
         </div>
      </div>
   </main>

   <footer>
      <div class="d-flex justify-content-end me-10">
         <div class="d-flex flex-column">
            <span class="fs-4 text-center" id="date-now"></span>
            <span class="fs-4 text-center fw-bold">Yang Memeriksa</span>
         </div>
      </div>
      <div class="d-flex justify-content-end mt-20">
         <div class="d-flex flex-column">
            <span class="fs-4 text-center fw-bold text-uppercase text-decoration-underline">Dr. Jhonny Pardede</span>
            <span class="fs-4 text-center text-uppercase">NIP. 09019039123001239</span>
         </div>
      </div>
   </footer>
</div>