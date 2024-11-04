import { renderDataPetugasPoli } from "./read.js"

const deleteDataPetugasPoli = async (uuidPetugasPoli) => {
    console.log(uuidPetugasPoli)
    try {
        // Request endpoint data petugas-poli
        const response = await sendApiRequest({
            url: `/api/web/master-data/petugas-poli/delete/${uuidPetugasPoli}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataPetugasPoli)
        }
    }
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-petugas-poli');

    tableContainer.on('click', '.delete-data-button', function (event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidPetugasPoli = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataPetugasPoli(uuidPetugasPoli);
        })
    });
}

export { deleteEvent }