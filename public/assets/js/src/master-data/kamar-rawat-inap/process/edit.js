import { KamarModalHandler, BedModalHandler } from "../components/modal/modal.js";

const editEvents = () => {
    $(document).ready(function () {
        const kamarModalHandler = new KamarModalHandler();
        // Event listener for the "Edit" button in the DataTable
        $('#table-kamar').on('click', '.edit-data-button', function () {
            const uuidKamar = $(this).data('uuid');
            // Call the modal edit handler function with uuidKamar and nama as parameters
            kamarModalHandler.modalEditHandler(uuidKamar);
        });

        // Event listener for the "Bed" button in the DataTable
        $('#table-kamar').on('click', '.bed-button', function () {
            const uuidKamar = $(this).data('uuid');
            const namaKamar = $(this).data('nama');
            const bedModalHandler = new BedModalHandler(uuidKamar, namaKamar);
            // Call the modal show handler function
            bedModalHandler.modalShowHandler();
        });
    });
}

export { editEvents }