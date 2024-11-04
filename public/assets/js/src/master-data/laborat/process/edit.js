import { LaboratModalHandler } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const laboratModalHandler = new LaboratModalHandler($('#form-laborat'));
        // Event listener for the "Edit" button in the DataTable
        $('#table-laborat').on('click', '.edit-data-button', function () {
            const uuidLaborat = $(this).data('uuid');
            // Call the modal edit handler function with uuidLaborat and nama as parameters
            laboratModalHandler.modalEditHandler(uuidLaborat);
        });
    });    
}

export {editEvents}