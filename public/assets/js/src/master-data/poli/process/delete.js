import { renderDataPoliklinik } from "./read.js"

const deleteDataPoliklinik = async (uuidPoliklinik) => {
    console.log(uuidPoliklinik)
    try {
        // Request endpoint data poliklinik
        const response = await sendApiRequest({
            url: `/api/web/master-data/poli/delete/${uuidPoliklinik}`,
            type: 'DELETE',
        }, true);
        if (response.status == "OK") {
            swalSuccess(response.message, renderDataPoliklinik)
        }
    }
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-poliklinik');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidPoliklinik = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataPoliklinik(uuidPoliklinik);
        })
    });
}

export { deleteEvent }