import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const pegawaiModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-pegawai').on('click', '.edit-data-button', function () {
            const uuidTindakan = $(this).data('uuid');
            // Call the modal edit handler function with uuidTindakan and nama as parameters
            pegawaiModalHandler.modalEditHandler(uuidTindakan);
        });
    });    
}

export {editEvents}