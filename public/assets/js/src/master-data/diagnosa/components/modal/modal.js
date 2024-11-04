import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

/**
 * Represents a modal input handler for Diagnosa management.
 *
 * @class
 */
class ModalInput {
    /**
     * Creates a new instance of ModalInput.
     *
     * @constructor
     */
    constructor() {
        /**
         * The form manager instance associated with the modal form.
         *
         * @member {FormManager}
         */
        this.formManager = formInput;
        
        /**
         * The title element inside the modal used for displaying the modal title.
         *
         * @member {jQuery}
         */
        this.titleModal = $("#title-diagnosa");
        
        /**
         * The button element used for form submission inside the modal.
         *
         * @member {jQuery}
         */
        this.buttonSubmit = $("#submit-button-diagnosa");
    }

    /**
     * Handles modal behavior for adding a new Diagnosa.
     */
    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/diagnosa/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Diagnosa");
        this.buttonSubmit.text("Simpan");
    }

    /**
     * Handles modal behavior for editing an existing Diagnosa.
     *
     * @param {string} uuidDiagnosa - The unique identifier of the Diagnosa to be edited.
     */
    async modalEditHandler(uuidDiagnosa) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(`/api/web/master-data/diagnosa/update/${uuidDiagnosa}`);
        
        // Fetch Diagnosa data by its unique identifier
        const dataDiagnosa = await getDataById(uuidDiagnosa);
        
        // Fill the form with Diagnosa data for editing
        this.formManager.fillForm(dataDiagnosa);
        
        this.titleModal.text("Edit Diagnosa");
        this.buttonSubmit.text("Simpan perubahan");
        $('#modal-diagnosa').modal('show');
    }
}

export { ModalInput };
