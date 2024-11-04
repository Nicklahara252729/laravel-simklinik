import { renderDataLaboratKategori } from './read.js';
/**
 * Delete data laborat
 */

const deleteDataLaboratKategori = async (uuid_laborat_kategori) => {
    try {
        // Request endpoint data laborat
        const response = await sendApiRequest({
            url: `/api/web/master-data/laborat-kategori/delete/${uuid_laborat_kategori}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataLaboratKategori)
        }
    }
    catch (error) {
        swalError(error, () => {})
    }
}

const deleteEvents = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-laborat-kategori');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuid_laborat_kategori = target.data('uuid');
        const kategori = target.data('kategori');
        const deleteMessage = msgConfirmDelete(kategori);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataLaboratKategori(uuid_laborat_kategori);
        })
    });
}

export { deleteDataLaboratKategori, deleteEvents }