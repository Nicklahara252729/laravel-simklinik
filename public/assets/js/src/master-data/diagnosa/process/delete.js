import { renderDataDiagnosa } from "./read.js";

/**
 * Deletes a diagnosa data by its UUID.
 *
 * @param {string} uuidDiagnosa - The unique identifier of the diagnosa to be deleted.
 */
const deleteDataDiagnosa = async (uuidDiagnosa) => {
    try {
        // Request endpoint to delete diagnosa data
        const response = await sendApiRequest({
            url: `/api/web/master-data/diagnosa/delete/${uuidDiagnosa}`,
            type: 'DELETE',
        }, true);

        if (response.status === "OK") {
            // Display success message and render updated diagnosa data
            swalSuccess(response.data, renderDataDiagnosa);
        }
    } catch (error) {
        // Display error message if deletion fails
        swalError(error);
    }
};

/**
 * Initializes event listener for deleting diagnosa data.
 */
const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-diagnosa');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidDiagnosa = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);

        // Display confirmation dialog and delete data if confirmed
        swalConfirmDelete(deleteMessage, () => {
            deleteDataDiagnosa(uuidDiagnosa);
        });
    });
};

export { deleteEvent };
