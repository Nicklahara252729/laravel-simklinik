import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
import { bedManager } from "../../../../../helpers/BedManager.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class KamarModalHandler {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-kamar");
        this.buttonSubmit = $("#submit-button-kamar")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/kamar/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Kamar");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidKamar) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/kamar/update/${uuidKamar}`
        );
        const dataKamar = await getDataById(uuidKamar);
        this.formManager.fillForm(dataKamar);
        this.titleModal.text("Edit Kamar");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-kamar').modal('show');
    }
}

class BedModalHandler {
    constructor(uuidKamar, namaKamar) {
        this.bedManager = bedManager;
        this.titleModal = $("#title-bed-kamar");
        this.modal = $("#modal-bed-kamar");
        this.uuid_kamar = uuidKamar;
        this.nama_kamar = namaKamar;
    }

    modalShowHandler() {
        this.bedManager.setUuidKamar(this.uuid_kamar);
        this.bedManager.refreshDataBed();
        this.titleModal.text(`Kamar ${this.nama_kamar}`);
        this.modal.modal("show");
    }
}

export { KamarModalHandler, BedModalHandler };
