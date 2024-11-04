import { renderDataSatuanObat } from './read.js';
/**
 * Delete data satuan obat
 */

const deleteDataSatuanObat = async (uuidSatuanObat) => {
    try {
        // Request endpoint data laborat
        const response = await sendApiRequest({
            url: `/api/web/master-data/satuan-obat/delete/${uuidSatuanObat}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataSatuanObat)
        }
    }
    catch (error) {
        swalError(error)
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-satuan-obat');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidSatuanObat = target.data('uuid');
        const satuan = target.data('satuan');
        const deleteMessage = msgConfirmDelete(satuan);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataSatuanObat(uuidSatuanObat);
        })
    });
}

export { deleteDataSatuanObat, deleteEvents }