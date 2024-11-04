import { getDataById } from "./../../process/read.js";
import { FormInputHandler } from "./../form/form.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class FaskesModalHandler {
    constructor() {
        this.formManager = FormInputHandler;
        this.titleModal = $("#title-faskes");
        this.buttonSubmit = $("#submit-button-faskes")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/faskes/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Faskes");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidFaskes) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(`/api/web/master-data/faskes/update/${uuidFaskes}`);
        const dataFaskes = await getDataById(uuidFaskes);
        this.formManager.fillForm(dataFaskes);
        this.titleModal.text("Edit Faskes");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-faskes').modal('show');
    }
}

export { FaskesModalHandler };
