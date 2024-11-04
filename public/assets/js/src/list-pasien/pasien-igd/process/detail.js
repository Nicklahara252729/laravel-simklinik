import { ModalInput } from "../components/modal/modal.js";

const detailEvent = () => {
   $(document).ready(function () {
      const listPasienHandler = new ModalInput();
      $('#table-list-pasien-igd').on('click', '.list-data-button', function () {
         const uuid_pendaftaran = $(this).data('uuid');
         console.log(uuid_pendaftaran);
         listPasienHandler.modalListHandler(uuid_pendaftaran);
      });
   });
}

export { detailEvent }