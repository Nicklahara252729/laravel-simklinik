import { ModalInput } from "../components/modal/modal.js";

/**
 * Initializes event listeners for the "Edit" button in the DataTable.
 */
const editEvents = ()  => {
    $(document).ready(function () {
        const diagnosaModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-diagnosa').on('click', '.edit-data-button', function () {
            const uuidDiagnosa = $(this).data('uuid');
            // Call the modal edit handler function with uuidDiagnosa and nama as parameters
            diagnosaModalHandler.modalEditHandler(uuidDiagnosa);
        });
    });    
}

export {editEvents}