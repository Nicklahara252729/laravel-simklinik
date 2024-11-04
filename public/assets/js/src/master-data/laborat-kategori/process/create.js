import { LaboratKategoriModalHandler } from '../components/modal/modal.js';
/** 
 * create laborat
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const laboratKategoriModalHandler = new LaboratKategoriModalHandler();
        laboratKategoriModalHandler.modalAddHandler();
    })
}

export { createEvents }