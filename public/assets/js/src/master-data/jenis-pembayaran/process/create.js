import { ModalInput } from "../components/modal/modal.js";
/** 
 * create jenis-pembayaran
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const jenisPembayaranModalHandler = new ModalInput();
        jenisPembayaranModalHandler.modalAddHandler();
    })
}

export { createEvents }