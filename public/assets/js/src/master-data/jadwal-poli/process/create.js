import { ModalInput } from "../components/modal/modal.js";
/** 
 * create poliklinik
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const poliklinikModalHandler = new ModalInput();
        poliklinikModalHandler.modalAddHandler();
    })
}

export { createEvents }