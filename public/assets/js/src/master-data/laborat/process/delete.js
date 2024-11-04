import { renderDataLaborat } from './read.js';
/**
 * Delete data laborat
 */

const deleteDataLaborat = async (uuid_laborat) => {
    try {
        // Request endpoint data laborat
        const response = await sendApiRequest({
            url: `/api/web/master-data/laborat/delete/${uuid_laborat}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataLaborat)
        }      
    } 
    catch (error) {
        swalError(error, () => {})
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-laborat');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuid_laborat = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataLaborat(uuid_laborat);
        })
    });
}

export { deleteDataLaborat, deleteEvents }