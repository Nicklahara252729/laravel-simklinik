import { getAllData } from "./process/pasien-baru/read.js";

// Pasien IGD
import FormPendaftaranBaruIgdHandler from './process/pasien-baru/pasien-igd/create.js';
import FormPendaftaranLamaIgdHandler from './process/pasien-lama/pasien-igd/create.js';

// Pasien Rawat Inap
import FormPendaftaranBaruRawatInapHandler from './process/pasien-baru/pasien-rawat-inap/create.js'
import FormPendaftaranLamaRawatInapHandler from './process/pasien-lama/pasien-rawat-inap/create.js'

// Pasien Rawat Jalan
import FormPendaftaranBaruRawatJalanHandler from './process/pasien-baru/pasien-rawat-jalan/create.js'
import FormPendaftaranLamaRawatJalanHandler from './process/pasien-lama/pasien-rawat-jalan/create.js'

const formStepperComponent = $('.form-stepper');
formStepperComponent.show()

getAllData()


$("#tgl_lahir").flatpickr();
$("#reka-medis").hide();
const formPendaftaran = $("#form-pendaftaran-pasien")

/**
 * check if radion jenis pasien checked
 */
$("input[name='jenis-pasien']").change(function () {
   // Check if "pasien-lama" is checked
   if ($("#pasien-lama").prop("checked")) {
      $('#next-button').hide()
      $('#step-4').hide()
      $("#reka-medis").show();

      if ($('input[name="jenis_layanan"]:checked').val() === 'igd') {
         const formLamaIgd = new FormPendaftaranLamaIgdHandler();
         formLamaIgd.pendaftaranHandler();
      }

      if ($('input[name="jenis_layanan"]:checked').val() === 'rawat inap') {
         const formLamaRawatInap = new FormPendaftaranLamaRawatInapHandler()
         formLamaRawatInap.pendaftaranHandler();
      }

      if ($('input[name="jenis_layanan"]:checked').val() === 'rawat jalan') {
         const formLamaRawatJalan = new FormPendaftaranLamaRawatJalanHandler()
         formLamaRawatJalan.pendaftaranHandler();
      }

   } else {
      $("#reka-medis").hide();
      $('#step-4').show()

      function resetFormFields(containerId) {
         // Get the container element
         var container = document.getElementById(containerId);

         // Check if the container exists
         if (container) {
            // Find all input and select elements within the container
            var inputElements = container.querySelectorAll('input');
            var selectElements = container.querySelectorAll('select');

            // Reset the values of input elements
            inputElements.forEach(function (input) {
               input.value = '';
            });
         }

         $("#gender").val("").trigger("change");
         $("#golongan_darah").val("").trigger("change");
      }

      function setFormFieldsReadonly(containerId, readonly) {
         // Get the container element
         var container = document.getElementById(containerId);

         if (container) {
            // Find all input and select elements within the container
            var inputElements = container.querySelectorAll('input');
            var selectElements = container.querySelectorAll('select');

            // Set or remove the readonly attribute for input elements
            inputElements.forEach(function (input) {
               input.readOnly = readonly;
            });

            // Set or remove the disabled attribute for select elements
            selectElements.forEach(function (select) {
               select.disabled = readonly;
            });
         }
      }

      // Example usage to allow input again
      setFormFieldsReadonly('step-4', false);

      // Example usage
      resetFormFields('step-4');

      if ($('input[name="jenis_layanan"]:checked').val() === 'igd') {
         const formBaruIgd = new FormPendaftaranBaruIgdHandler();
         formBaruIgd.pendaftaranHandler();
      }

      if ($('input[name="jenis_layanan"]:checked').val() === 'rawat inap') {
         const formBaruRawatinap = new FormPendaftaranBaruRawatInapHandler()
         formBaruRawatinap.pendaftaranHandler()
      }

      if ($('input[name="jenis_layanan"]:checked').val() === 'rawat jalan') {
         const formBaruRawatJalan = new FormPendaftaranBaruRawatJalanHandler()
         formBaruRawatJalan.pendaftaranHandler()
      }

   }
});

/**
 * check if radion jenis pasien checked
 */
$("#wrap-ruangan").hide();
$("input[name='jenis_layanan']").change(function () {
   // Check if "pasien-lama" is checked
   if ($("#check-rawat-inap").prop("checked")) {
      $("#wrap-ruangan").show();
      $("#wrap-tujuan").hide();
      $("#wrap-kunjungan").addClass("col-md-12");
      $("#wrap-kunjungan").removeClass("col-md-6");
   } else {
      $("#wrap-ruangan").hide();
      $("#wrap-tujuan").show();
      $("#wrap-kunjungan").addClass("col-md-6");
      $("#wrap-kunjungan").removeClass("col-md-12");
   }
});

/**
 * check if radion bpjs checked
 */
$("#no_bpjs").hide();
$("input[name='jenis_pelayanan']").change(function () {
   if ($("#bpjs").is(":checked")) {
      $("#no_bpjs").show();
      $("#wrap-jenis-pembayaran").hide()
   } else {
      $("#no_bpjs").hide();
      $("#wrap-jenis-pembayaran").show()
   }
});

/**
 *  show button kembali ke awal
 * */
const currentUrl = window.location.href;
const baseUrl_production = "https://simpus.infotekmetrodata.co.id/";
const baseUrl_local = "http://127.0.0.1:8000/";

if (currentUrl.startsWith(baseUrl_production) || currentUrl.startsWith(baseUrl_local)) {

   const relativeUrl = currentUrl.substring(baseUrl_production.length);
   const relativeUrl_local = currentUrl.substring(baseUrl_local.length);

   if (relativeUrl === 'pendaftaran/pendaftaran-pasien' || relativeUrl_local === 'pendaftaran/pendaftaran-pasien') {
      document.getElementById('back-to-start').hidden = false
   }

} else {
   console.log("The base URL is not present in the current URL.");
}

/**
 * Validated Step 2
 */
const validateFormStepTwo = function () {
   try {
      var requiredFields = [
         'nama_pj',
         'alamat_pj',
         'no_hp',
         'provinsi',
         'kabupaten',
         'kecamatan',
         'desa',
         'poliklinik',
         'kunjungan',
      ];
      var isFormValid = true;

      requiredFields.forEach(function (fieldName) {
         var fieldValue = document.getElementById(fieldName).value.trim();
         var messageElement = document.getElementById(fieldName + '_message');

         if (fieldValue === '') {
            messageElement.textContent = 'Kolom ini tidak boleh kosong.';
            isFormValid = false;
         } else {
            messageElement.textContent = '';
         }
      });

      return isFormValid;

   } catch (error) {
      console.error(error);
      throw error;
   }
};


export { validateFormStepTwo }