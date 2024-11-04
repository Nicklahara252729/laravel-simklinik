import { ModalInput } from "../components/modal/modal.js";
/** 
 * create petugas-poli
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const PetugasPoliModalHandler = new ModalInput();
        PetugasPoliModalHandler.modalAddHandler();
    })
}

export { createEvents }