import { renderDataPegawai } from "./read.js"

const deleteDataPegawai = async (uuidPegawai) => {
    console.log(uuidPegawai)
    try {
        // Request endpoint data pegawai
        const response = await sendApiRequest({
            url: `/api/web/master-data/pegawai/delete/${uuidPegawai}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataPegawai)
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = () => {
    // Assuming 'tableContainer' is the ID of the parent container of your DataTable
    const tableContainer = $('#table-pegawai');

    tableContainer.on('click', '.delete-data-button', function(event) {
        const target = $(this);

        // Check if the clicked element is a delete button inside the DataTable
        const uuidPegawai = target.data('uuid');
        const nama = target.data('nama');
        const deleteMessage = msgConfirmDelete(nama);
        swalConfirmDelete(deleteMessage, () => {
            deleteDataPegawai(uuidPegawai);
        })
    });
}

export { deleteEvent }