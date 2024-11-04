import { ModalInput } from "../components/modal/modal.js";
/** 
 * create klasifikasi-obat
 */

const createEvents = () => {
    $('#open-create-modal').on('click', () => {
        const klasifikasiObatModalHandler = new ModalInput();
        klasifikasiObatModalHandler.modalAddHandler();
    })
}

export { createEvents }