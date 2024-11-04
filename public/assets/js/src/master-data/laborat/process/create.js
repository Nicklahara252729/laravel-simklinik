import { LaboratModalHandler } from '../components/modal/modal.js';
import { JenisPembayaranHargaForm } from '../../../../helpers/JenisPembayaranHargaForm.js';
/** 
 * create laborat
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const laboratModalHandler = new LaboratModalHandler();
        laboratModalHandler.modalAddHandler();

        const jenisPembayaranHargaForm = new JenisPembayaranHargaForm($("#container-row-jenis-pembayaran-harga"), null , 'laborat', laboratModalHandler.formManager.form);
    })
}

export { createEvents }