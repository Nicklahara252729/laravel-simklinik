import { renderDataPengguna } from "./read.js"

const deleteDataPengguna = async (uuidPengguna) => {
    console.log(uuidPengguna)
    try {
        // Request endpoint data pengguna
        const response = await sendApiRequest({
            url: `/api/web/master-data/pengguna/delete/${uuidPengguna}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataPengguna)
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-pengguna');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidPengguna = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataPengguna(uuidPengguna);
        })
    });
}

export { deleteEvent }