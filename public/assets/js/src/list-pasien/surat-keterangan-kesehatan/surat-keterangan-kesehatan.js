document.getElementById('generate-surat').addEventListener('click', function () {
   const cardElement = document.querySelector('#surat-keterangan');
   const options = {
      margin: 10,
      filename: 'surat-keterangan.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
   };

   // Call html2pdf library to generate PDF
   html2pdf().from(cardElement).set(options).save();
});


const getDataSuratByNoRM = async (no_rm) => {
   try {
      const response = await sendApiRequest({
         url: `/api/web/list-pasien/surat-keterangan/get/${no_rm}`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
}

const getDataProfile = async (no_rm) => {
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
      $("#nama_faskes").text(data.nama_faskes);
      $("#alamat_faskes").text(data.alamat_faskes);
   } else {
      console.error('Data Faskes is undefined');
   }
}

const updateSurat = (data) => {
   if (data) {
      $("#nama_pasien").text(': ' + data.nama_pasien);
      $("#tgl_lahir").text(': ' + data.tgl_lahir);
      $("#gender").text(': ' + data.gender);
      $("#alamat").text(': ' + data.alamat);
      $("#no_hp").text(': ' + data.no_hp);
      $("#no_rm").text(': ' + data.no_rm);
      $("#no_surat").text(': ' + data.no_surat);
   } else {
      console.error('Data is undefined');
   }
}

const fetchDataAndUpdateSurat = async () => {
   // try {
   // Get the input value
   const noRmValue = $("input[name='no_rm']").val();

   // Fetch data based on no_rm
   const data = await getDataSuratByNoRM(noRmValue);

   // Fetch data faskes
   const dataFaskes = await getDataProfile()

   // Update the card with the fetched data
   updateSurat(data);

   updateFaskes(dataFaskes)

   $("#surat-keterangan").removeAttr("hidden");
   // } catch (e) {
   //    const errorMessage = e.responseJSON && e.responseJSON.message ? e.responseJSON.message : "Oops, Something error :(";
   //    swalError(errorMessage, () => { })
   // }
}

$("input[name='no_rm']").on('keyup', fetchDataAndUpdateSurat);

// Get the current date
var currentDate = new Date();

// Format the date as desired
var day = currentDate.getDate();
var monthIndex = currentDate.getMonth();
var year = currentDate.getFullYear();

// Array of month names
var monthNames = [
   "Januari", "Februari", "Maret", "April", "Mei", "Juni",
   "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Update the content of the element with id "date-now"
var dateElement = document.getElementById("date-now");
dateElement.textContent = day + ' ' + monthNames[monthIndex] + ' ' + year;