import { TindakanModalHandler } from '../components/modal/modal.js';
import { JenisPembayaranHargaForm } from '../../../../helpers/JenisPembayaranHargaForm.js';
/** 
 * create tindakan
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const tindakanModalHandler = new TindakanModalHandler();
        tindakanModalHandler.modalAddHandler();

        const jenisPembayaranHargaForm = new JenisPembayaranHargaForm($('#container-row-jenis-pembayaran-harga'), null, 'tindakan', tindakanModalHandler.formManager.form) 
    })
}

export { createEvents }