import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const penggunaModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-pengguna').on('click', '.edit-data-button', function () {
            const uuidTindakan = $(this).data('uuid');
            // Call the modal edit handler function with uuidTindakan and nama as parameters
            penggunaModalHandler.modalEditHandler(uuidTindakan);
        });
    });    
}

export {editEvents}