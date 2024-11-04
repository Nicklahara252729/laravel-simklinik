import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

// /**
//  * differentiator Modal Add and Edit
//  */
class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-satuan-obat");
        this.buttonSubmit = $("#submit-button-satuan-obat")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/satuan-obat/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Satuan Obat");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidSatuanObat) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/satuan-obat/update/${uuidSatuanObat}`
        );
        const dataSatuanObat = await getDataById(uuidSatuanObat);
        this.formManager.fillForm(dataSatuanObat);
        this.titleModal.text("Edit Satuan Obat");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-satuan-obat').modal('show');
    }
}

export { ModalInput };
