import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const poliklinikModalHandler = new ModalInput();

        const day = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
        day.forEach((item) => {
            // Event listener for the "Edit" button in the DataTable
            $(`#table-jadwal-poli-${item}`).on('click', '.edit-data-button', function () {
                const uuidTindakan = $(this).data('uuid');
                // Call the modal edit handler function with uuidTindakan and nama as parameters
                poliklinikModalHandler.modalEditHandler(uuidTindakan);
            });
        })

    });    
}

export {editEvents}