import { renderDataJadwalPoli } from "./read.js"

const deleteJadwalPoli = async (uuidJadwalPoli) => {
    try {
        // Request endpoint data poliklinik
        const response = await sendApiRequest({
            url: `/api/web/master-data/jadwal-poli/delete/${uuidJadwalPoli}`,
            type: 'DELETE',
        }, true);
        if (response.status) {
            swalSuccess(response.message, renderDataJadwalPoli)
        }      
    } 
    catch (error) {
        swalError(error)
    }
}

const deleteEvent = async () => {
    const day = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
    day.forEach((item) => {
        const tableContainer = $(`#table-jadwal-poli-${item}`);
    
        tableContainer.on('click', '.delete-data-button', function(event) {
            const target = $(this);
    
            // Check if the clicked element is a delete button inside the DataTable
            const uuidJadwalPoli = target.data('uuid');
            const nama = target.data('poliklinik');
            const deleteMessage = msgConfirmDelete(nama);
            swalConfirmDelete(deleteMessage, () => {
                deleteJadwalPoli(uuidJadwalPoli);
            })
        });
    })
}

export { deleteEvent }