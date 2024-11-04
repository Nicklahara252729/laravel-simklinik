import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const RoleModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-role').on('click', '.edit-data-button', function () {
            const uuidRole = $(this).data('uuid');
            // Call the modal edit handler function with uuidRole and nama as parameters
            RoleModalHandler.modalEditHandler(uuidRole);
        });
    });    
}

export {editEvents}