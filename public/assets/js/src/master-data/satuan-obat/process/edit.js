import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const satuanObatModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-satuan-obat').on('click', '.edit-data-button', function () {
            const uuidSatuanObat = $(this).data('uuid');
            // Call the modal edit handler function with uuidSatuanObat and nama as parameters
            satuanObatModalHandler.modalEditHandler(uuidSatuanObat);
        });
    });    
}

export {editEvents}