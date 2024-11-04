import { renderDataTindakan } from './read.js';
/**
 * Delete data tindakan
 */

const deleteDataTindakan = async (uuid_tindakan) => {
    try {
        // Request endpoint data tindakan
        const response = await sendApiRequest({
            url: `/api/web/master-data/tindakan/delete/${uuid_tindakan}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataTindakan)
        }
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-tindakan');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuid_tindakan = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataTindakan(uuid_tindakan);
        })
    });
}

export { deleteDataTindakan, deleteEvents }