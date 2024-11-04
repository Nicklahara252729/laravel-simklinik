document.getElementById('generate-card').addEventListener('click', function () {
   const cardElement = document.querySelector('#kartu-pasien');

   const options = {
      margin: 10,
      filename: 'kartu-pasien.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a5', orientation: 'landscape' }
   };

   // Call html2pdf library to generate PDF
   html2pdf().from(cardElement).set(options).save();
});


const getDataKartuByNoRM = async (no_rm) => {
   try {
      const response = await sendApiRequest({
         url: `/api/web/list-pasien/kartu-pasien/get/${no_rm}`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
}

const getDataProfile = async () => {
   try {
      const response = await sendApiRequest({
         url: `/api/profil/data`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
}

const updateFaskes = (data) => {
   if (data) {
      $("#nama_puskesmas").text(data.nama_faskes);
      $("#phone").text(data.phone);
   } else {
      console.error('Data Faskes is undefined');
   }
}

const updateCard = (data) => {
   if (data) {
      $("#no_rm").text(': ' + data.no_rm);
      $("#no_ktp").text(': ' + data.no_ktp);
      $("#nama_pasien").text(': ' + data.nama_pasien);
      $("#gender").text(': ' + data.gender);
      $("#umur").text(': ' + data.umur);
      $("#tgl_lahir").text(': ' + data.tgl_lahir);
      $("#alamat").text(': ' + data.alamat);
      $("#no_hp").text(': ' + data.no_hp);
      $("#tgl_daftar").text(': ' + data.tgl_daftar);

      const fotoUrl = data.foto;
      $("#foto").attr('src', fotoUrl);

   } else {
      console.error('Data is undefined');
   }
}

const fetchDataAndUpdateCard = async () => {
   // try {
   // Get the input value
   const noRmValue = $("input[name='no_rm']").val();

   // Fetch data based on no_rm
   const data = await getDataKartuByNoRM(noRmValue);

   // Fetch data faskes
   const dataFaskes = await getDataProfile()

   // Update the card with the fetched data
   updateCard(data);

   updateFaskes(dataFaskes)

   $("#kartu-pasien").removeAttr("hidden");
   // } catch (e) {
   //    const errorMessage = e.responseJSON && e.responseJSON.message ? e.responseJSON.message : "Oops, Something error :(";
   //    swalError(errorMessage, () => { })
   // }
}

$("input[name='no_rm']").on('keyup', fetchDataAndUpdateCard);