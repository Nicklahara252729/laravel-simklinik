import { renderDataKamar } from './read.js';
/**
 * Delete data tindakan
 */

const deleteDataKamar = async (uuid_kamar) => {
    try {
        // Request endpoint data tindakan
        const response = await sendApiRequest({
            url: `/api/web/master-data/kamar/delete/${uuid_kamar}`,
            type: 'DELETE',
        }, true);
        if (response.status == "OK") {
            swalSuccess("Data Kamar berhasil dihapus", renderDataKamar)
        }
    }
    catch (error) {
        swalError(error)
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-kamar');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuid_kamar = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataKamar(uuid_kamar);
        })
    });
}

export { deleteDataKamar, deleteEvents }