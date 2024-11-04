import { ModalInput } from '../components/modal/modal.js';
import { formJenisPembayaranHarga } from '../components/form/JenisPembayaranHargaForm.js';
/** 
 * create master obat
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const dataObatModalHandler = new ModalInput();
        dataObatModalHandler.modalAddHandler();

        const jenisPembayaranHargaForm = new formJenisPembayaranHarga($("#container-row-jenis-pembayaran-harga"), null, 'data-obat ');

    })
}

export { createEvents }