import { renderDataRole } from "./read.js"

const deleteDataRole = async (uuidRole) => {
    console.log(uuidRole)
    try {
        // Request endpoint data role
        const response = await sendApiRequest({
            url: `/api/web/master-data/role/delete/${uuidRole}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataRole)
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-role');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidRole = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataRole(uuidRole);
        })
    });
}

export { deleteEvent }