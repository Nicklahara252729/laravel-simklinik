import { KamarModalHandler } from '../components/modal/modal.js';
/** 
 * create tindakan
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const kamarModalHandler = new KamarModalHandler();
        kamarModalHandler.modalAddHandler();
    })
}

export { createEvents }