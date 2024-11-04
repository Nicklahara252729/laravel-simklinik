import { renderDataJenisPembayaran } from "./read.js"

const deleteDataJenisPembayaran = async (uuidJenisPembayaran) => {
    console.log(uuidJenisPembayaran)
    try {
        // Request endpoint data jenis-pembayaran
        const response = await sendApiRequest({
            url: `/api/web/master-data/jenis-pembayaran/delete/${uuidJenisPembayaran}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, async () => {await renderDataJenisPembayaran()})
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-jenis-pembayaran');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidJenisPembayaran = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataJenisPembayaran(uuidJenisPembayaran);
        })
    });
}

export { deleteEvent }