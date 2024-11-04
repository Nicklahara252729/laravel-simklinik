import { renderDataFaskes } from './read.js';
/**
 * Delete data tindakan
 */

const deleteDataFaskes = async (uuid_faskes) => {
    try {
        // Request endpoint data tindakan
        const response = await sendApiRequest({
            url: `/api/web/master-data/faskes/delete/${uuid_faskes}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, async () => {
                renderDataFaskes()
            })
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-faskes');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuid_faskes = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataFaskes(uuid_faskes);
        })
    });
}

export { deleteDataFaskes, deleteEvents }