import { renderDataSpesialis } from "./read.js"

const deleteDataSpesialis = async (uuidSpesialis) => {
    console.log(uuidSpesialis)
    try {
        // Request endpoint data spesialis
        const response = await sendApiRequest({
            url: `/api/web/master-data/data-spesialis/delete/${uuidSpesialis}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, async () => {await renderDataSpesialis()})
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-spesialis');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidSpesialis = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataSpesialis(uuidSpesialis);
        })
    });
}

export { deleteEvent }