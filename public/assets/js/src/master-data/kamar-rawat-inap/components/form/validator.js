import { masksOptions } from "./mask.js";

const defaultValidator = FormValidation.formValidation(
    $("#form-kamar")[0],
    {
        fields: {
            "nama_kamar": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong"
                    }
                }
            },
            "jumlah_bed": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong"
                    }
                }
            },
            "harga": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong"
                    },
                    // callback: {
                    //     message: "Harga tidak valid",
                    //     callback: function (input) {
                    //         return Inputmask.isValid(input.value, masksOptions.harga);
                    //     }
                    // }
                }
            },
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

export default defaultValidator;
