import { renderDataDataObat } from './read.js';
/**
 * Delete data data-obat
 */

const deleteDataDataObat = async (uuidDataObat) => {
    try {
        // Request endpoint data data-obat
        const response = await sendApiRequest({
            url: `/api/web/master-data/data-obat/delete/${uuidDataObat}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataDataObat)
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-data-obat');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidDataObat = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataDataObat(uuidDataObat);
        })
    });
}

export { deleteDataDataObat, deleteEvents }