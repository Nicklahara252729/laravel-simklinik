import { ModalInput } from "../components/modal/modal.js";

const editEvents = ()  => {
    $(document).ready(function () {
        const PetugasPoliModalHandler = new ModalInput();
        // Event listener for the "Edit" button in the DataTable
        $('#table-petugas-poli').on('click', '.edit-data-button', function () {
            const uuidPetugasPoli = $(this).data('uuid');
            // Call the modal edit handler function with uuidPetugasPoli and nama as parameters
            PetugasPoliModalHandler.modalEditHandler(uuidPetugasPoli);
        });
    });    
}

export {editEvents}