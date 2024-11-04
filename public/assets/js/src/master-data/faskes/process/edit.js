import { FaskesModalHandler } from "../components/modal/modal.js";

const editEvents = () => {
    $(document).ready(function () {
        const faskesModalHandler = new FaskesModalHandler();
        // Event listener for the "Edit" button in the DataTable
        $('#table-faskes').on('click', '.edit-data-button', function () {
            const uuidFaskes = $(this).data('uuid');
            // Call the modal edit handler function with uuidFaskes and nama as parameters
            faskesModalHandler.modalEditHandler(uuidFaskes);
        });
    });
}

export { editEvents }