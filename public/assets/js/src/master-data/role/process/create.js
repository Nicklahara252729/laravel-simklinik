import { ModalInput } from "../components/modal/modal.js";
/** 
 * create form-role
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const PetugasPoliModalHandler = new ModalInput();
        PetugasPoliModalHandler.modalAddHandler();
    })
}

export { createEvents }