import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-role");
        this.buttonSubmit = $("#submit-button-role")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/role/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah role");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidRole) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/role/update/${uuidRole}`
        );
        const dataUuidRole = await getDataById(uuidRole);
        this.formManager.fillForm(dataUuidRole);
        this.titleModal.text("Edit role");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-role').modal('show');
    }
}

export { ModalInput }