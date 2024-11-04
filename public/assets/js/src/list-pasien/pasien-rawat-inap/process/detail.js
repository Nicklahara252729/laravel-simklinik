import { ModalInput } from "../components/modal/modal.js";

const detailEvent = () => {
   $(document).ready(function () {
      const listPasienHandler = new ModalInput();
      $('#table-list-pasien-rawat-inap').on('click', '.list-data-button', function () {
         const uuidDataPribadi = $(this).data('uuid');
         listPasienHandler.modalListHandler(uuidDataPribadi);
      });
   });
}

export { detailEvent }