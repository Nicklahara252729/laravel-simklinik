import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const jenisPembayaranModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-spesialis').on('click', '.edit-data-button', function () {
            const uuidSpesialis = $(this).data('uuid');
            // Call the modal edit handler function with uuidSpesialis and nama as parameters
            const spesialisModalHandler = new ModalInput();
            spesialisModalHandler.modalEditHandler(uuidSpesialis);
        });
    });    
}

export {editEvents}