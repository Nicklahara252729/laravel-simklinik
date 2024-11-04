import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const jenisPembayaranModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-jenis-pembayaran').on('click', '.edit-data-button', function () {
            const uuidJenisPembayaran = $(this).data('uuid');
            // Call the modal edit handler function with uuidJenisPembayaran and nama as parameters
            jenisPembayaranModalHandler.modalEditHandler(uuidJenisPembayaran);
        });
    });    
}

export {editEvents}