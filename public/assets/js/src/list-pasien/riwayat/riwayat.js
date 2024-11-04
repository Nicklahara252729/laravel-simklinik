document.getElementById('generate-surat').addEventListener('click', function () {
   const cardElement = document.querySelector('#surat-riwayat');
   console.log('ki');
   const options = {
      margin: 10,
      filename: 'surat-riwayat.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
   };

   // Call html2pdf library to generate PDF
   html2pdf().from(cardElement).set(options).save();
});

const fetchDataAndUpdateCard = async () => {
   $("#surat-riwayat").removeAttr("hidden");
}

$("input[name='no_rm']").on('keyup', fetchDataAndUpdateCard);