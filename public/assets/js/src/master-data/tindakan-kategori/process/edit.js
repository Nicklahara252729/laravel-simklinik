import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const tindakanKategoriModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-tindakan-kategori').on('click', '.edit-data-button', function () {
            const uuidTindakanKategori = $(this).data('uuid');
            // Call the modal edit handler function with uuidTindakanKategori and nama as parameters
            tindakanKategoriModalHandler.modalEditHandler(uuidTindakanKategori);
        });
    });    
}

export {editEvents}