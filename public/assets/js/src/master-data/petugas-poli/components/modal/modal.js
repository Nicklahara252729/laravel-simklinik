import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor(formElement) {
        this.formManager = formInput;
        this.titleModal = $("#title-petugas-poli");
        this.buttonSubmit = $("#submit-button-petugas-poli")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/petugas-poli/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah petugas poli");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidPetugasPoli) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/petugas-poli/update/${uuidPetugasPoli}`
        );
        const dataUuidPetugasPoli = await getDataById(uuidPetugasPoli);
        console.log(dataUuidPetugasPoli)
        this.formManager.fillForm(dataUuidPetugasPoli);
        this.titleModal.text("Edit petugas poli");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-petugas-poli').modal('show');
    }
}

export {ModalInput}