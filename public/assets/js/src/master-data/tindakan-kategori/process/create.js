import { ModalInput } from "../components/modal/modal.js";
/** 
 * create poliklinik
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const tindakanKategoriModalHandler = new ModalInput();
        tindakanKategoriModalHandler.modalAddHandler();
    })
}

export { createEvents }