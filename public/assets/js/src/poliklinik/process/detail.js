import { ModalInput } from "../components/modal/modal.js";

const detailInit = () => {
    const poliklinikModalHandler = new ModalInput();
    $("#table-poliklinik").on('click', '.detail-button', async function () {
        const uuidTindakan = $(this).data('uuid');
        console.log(uuidTindakan)
        const data = await poliklinikModalHandler.modalDetailHandler(uuidTindakan);
    })
}

export { detailInit }