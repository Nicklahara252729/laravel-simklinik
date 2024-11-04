import { ModalInput } from "../components/modal/modal.js";
/** 
 * create pegawai
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const pegawaiModalHandler = new ModalInput();
        pegawaiModalHandler.modalAddHandler();
    })
}

export { createEvents }