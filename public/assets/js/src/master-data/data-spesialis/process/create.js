import { ModalInput } from "../components/modal/modal.js";
/** 
 * create jenis-pembayaran
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const spesialisModalHandler = new ModalInput();
        spesialisModalHandler.modalAddHandler();
    })
}

export { createEvents }