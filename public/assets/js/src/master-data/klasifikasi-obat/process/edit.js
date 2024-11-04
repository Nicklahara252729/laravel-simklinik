import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const klasifikasiObatModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-klasifikasi-obat').on('click', '.edit-data-button', function () {
            const uuidKlasifikasiObat = $(this).data('uuid');
            // Call the modal edit handler function with uuidKlasifikasiObat and nama as parameters
            klasifikasiObatModalHandler.modalEditHandler(uuidKlasifikasiObat);
        });
    });    
}

export {editEvents}