import { renderDataTindakanKategori } from "./read.js"

const deleteDataTindakanKategori = async (uuidTindakanKategori) => {
    try {
        // Request endpoint data tindakan-kategori
        const response = await sendApiRequest({
            url: `/api/web/master-data/tindakan-kategori/delete/${uuidTindakanKategori}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataTindakanKategori)
        }
    }
    catch (error) {
        swalError(error, () => {})   
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-tindakan-kategori');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidTindakanKategori = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataTindakanKategori(uuidTindakanKategori);
        })
    });
}

export { deleteEvent }