import { renderDataKlasifikasiObat } from "./read.js"

const deleteDataKlasifikasrenderDataKlasifikasiObat = async (uuidKlasifikasiObat) => {
    console.log(uuidKlasifikasiObat)
    try {
        // Request endpoint data klasifikasi-obat
        const response = await sendApiRequest({
            url: `/api/web/master-data/klasifikasi-obat/delete/${uuidKlasifikasiObat}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataKlasifikasiObat)
        }
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-klasifikasi-obat');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidKlasifikasiObat = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataKlasifikasrenderDataKlasifikasiObat(uuidKlasifikasiObat);
        })
    });
}

export { deleteEvent }