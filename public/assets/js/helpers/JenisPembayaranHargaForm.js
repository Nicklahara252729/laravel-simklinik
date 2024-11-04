import { getDataJenisPembayaran } from "../src/master-data/jenis-pembayaran/process/read.js";
class JenisPembayaranHargaForm {
    constructor(container, initialData = null, modal, form) {
        this.container = container;
        this.optionsData = null;
        this.modal = modal;
        this.form = form;
        this.masks = [];

        this.validator = null;
        this.initValidator();


        this.loadData().then(() => {
            this.setRowsFromData(initialData || []);
            this.initEventHandlers();
        });
    }

    async loadData() {
        try {
            this.optionsData = await getDataJenisPembayaran();
        } catch (error) {
            console.error(error);
        }
    }

    getValidator = () => {
        console.log('this.validator')
        return this.validator;
    }

    initEventHandlers() {
        $("#button-add-row-jenis-pembayaran-harga").off("click").on("click", this.addRowComponent.bind(this));
        this.container.off("click", ".delete-row-button").on("click", ".delete-row-button", this.deleteRowComponent.bind(this));
    }

    tableRowComponent(counterNumber, defaultData = {}) {
        const { uuid_jenis_pembayaran: UuidJenisPembayaran = '', harga_jual: hargaJual = '' } = defaultData;

        const options = this.optionsData.map(element => {
            return `<option value="${element.uuid_jp_link_faskes}" ${element.uuid_jp_link_faskes === UuidJenisPembayaran ? 'selected' : ''}> ${element.jenis_pembayaran} </option>`;
        }).join(' ');

        return `
            <tr class="jenis-pembayaran-harga-row">
                <td class="counter-cell h-full">${counterNumber}</td>
                <td class="fv-row">
                    <select class="form-select form-select-solid jenis-pembayaran" data-control="select2" data-placeholder="Pilih jenis pembayaran" name="uuid_jenis_pembayaran[]" data-dropdown-parent="#modal-${this.modal}">
                        <option></option>
                        ${options}
                    </select>
                </td>
                <td class="fv-row">
                    <div class="input-group input-group-solid">
                        <span class="input-group-text">Rp.</span>
                        <input inputmode="text" class="form-control form-control-solid" name="harga_jual[]" placeholder="Masukan harga jual" value="${hargaJual}" required />
                    </div>
                </td>
                <td>
                    <button class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger delete-row-button" type="button">
                        <i class="ki-outline ki-trash fs-1 p-0"></i>
                    </button>
                </td>
            </tr>
        `;
    }

    applyInputMaskToHargaJual(inputElement) {
        const inputMask = Inputmask({
            "alias": "numeric",
            "groupSeparator": ".",
            "autoGroup": true,
            // "digits": 0,
            // "digitsOptional": false,
            // "placeholder": "0",
            "rightAlign": false
        });
        inputMask.mask(inputElement);
        return inputMask;
    }

    addRowComponent(defaultData = {}) {
        const counterNumber = $('.jenis-pembayaran-harga-row').length + 1;
        const newRow = this.tableRowComponent(counterNumber, defaultData);
        this.container.append(newRow);

        this.container.find(".jenis-pembayaran-harga-row:last-child .jenis-pembayaran").select2();
        this.container.find(".jenis-pembayaran-harga-row:last-child .jenis-pembayaran").on("change", (event) => {
            this.validator.revalidateField('uuid_jenis_pembayaran[]')
        });

        const lastRowInput = this.container.find('.jenis-pembayaran-harga-row:last-child input[name="harga_jual[]"]');
        const inputMask = this.applyInputMaskToHargaJual(lastRowInput);

        const hargaJualValue = defaultData.harga_jual || '';
        inputMask.setValue(lastRowInput[0], hargaJualValue);

        this.initValidator();
    }

    initValidator = () => {
        // console.log(this)
        this.validator = FormValidation.formValidation(
            this.form[0],
            {
                fields: {
                    "uuid_jenis_pembayaran[]": {
                        validators: {
                            notEmpty : {
                                message: "Jenis pembayaran tidak boleh kosong"
                            }
                        }
                    },
                    "harga_jual[]": {
                        validators: {
                            notEmpty : {
                                message: "Harga jual tidak boleh kosong"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }
        );
    }

    deleteRowComponent(event) {
        $(event.target).closest("tr").remove();
        this.updateRowNumbers();
        this.initValidator();
    }

    updateRowNumbers() {
        const rows = this.container.find(".jenis-pembayaran-harga-row");
        rows.each((index, row) => {
            const rowNumber = index + 1;
            $(row).find("td:first-child").text(rowNumber);
        });
    }

    setRowsFromData(dataArray) {
        this.container.empty();
        dataArray.forEach((rowData, index) => {
            this.addRowComponent(rowData, index + 1);
        });
    }
}

export { JenisPembayaranHargaForm };
