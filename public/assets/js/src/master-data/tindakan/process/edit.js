import { TindakanModalHandler } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const tindakanModalHandler = new TindakanModalHandler();
        // Event listener for the "Edit" button in the DataTable
        $('#table-tindakan').on('click', '.edit-data-button', function () {
            const uuidTindakan = $(this).data('uuid');
            // Call the modal edit handler function with uuidTindakan and nama as parameters
            tindakanModalHandler.modalEditHandler(uuidTindakan);
        });
    });    
}

export {editEvents}