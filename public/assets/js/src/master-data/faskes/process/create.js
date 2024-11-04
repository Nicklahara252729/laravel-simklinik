import { FaskesModalHandler } from '../components/modal/modal.js';
/** 
 * create tindakan
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const faskesModalHandler = new FaskesModalHandler();
        faskesModalHandler.modalAddHandler();
    })
}

export { createEvents }