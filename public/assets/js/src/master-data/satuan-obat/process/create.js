import { ModalInput } from '../components/modal/modal.js';
/** 
 * create satuan obat
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const satuanObatModalHandler = new ModalInput();
        satuanObatModalHandler.modalAddHandler();
    })
}

export { createEvents }