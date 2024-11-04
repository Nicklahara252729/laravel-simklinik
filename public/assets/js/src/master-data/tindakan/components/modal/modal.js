import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class TindakanModalHandler {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-tindakan");
        this.titleFormTindakanHarga = $("#title-tindakan-harga");
        this.buttonSubmit = $("#submit_button_tindakan")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/tindakan/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Tindakan");
        this.buttonSubmit.text("Simpan")
        this.titleFormTindakanHarga.text("Tindakan Harga");
    }

    async modalEditHandler(uuidTindakan) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/tindakan/update/${uuidTindakan}`
        );
        const dataTindakan = await getDataById(uuidTindakan);
        this.formManager.fillForm(dataTindakan);
        this.titleModal.text("Edit Tindakan");
        this.buttonSubmit.text("Simpan perubahan")
        this.titleFormTindakanHarga.text("Edit Tindakan Harga");
        $('#modal-tindakan').modal('show');
    }
}

export { TindakanModalHandler };
