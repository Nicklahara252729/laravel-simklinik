import { LaboratKategoriModalHandler } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const laboratKategoriModalHandler = new LaboratKategoriModalHandler();
        // Event listener for the "Edit" button in the DataTable
        $('#table-laborat-kategori').on('click', '.edit-data-button', function () {
            const uuidLaboratKategori = $(this).data('uuid');
            // Call the modal edit handler function with uuidLaboratKategori and nama as parameters
            laboratKategoriModalHandler.modalEditHandler(uuidLaboratKategori);
        });
    });    
}

export {editEvents}