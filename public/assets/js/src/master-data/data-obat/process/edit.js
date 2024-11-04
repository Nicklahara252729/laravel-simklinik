import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const DataObatModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-data-obat').on('click', '.edit-data-button', function () {
            const uuidDataObat = $(this).data('uuid');
            // Call the modal edit handler function with uuidDataObat and nama as parameters
            DataObatModalHandler.modalEditHandler(uuidDataObat);
        });
    });    
}

export {editEvents}