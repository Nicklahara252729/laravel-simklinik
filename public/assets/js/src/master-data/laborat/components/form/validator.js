const defaultValidator = FormValidation.formValidation(
    $("#form-laborat")[0],
    {
        fields: {
            "kode": {
                validators: {
                    notEmpty: {
                        message: "Kode tidak boleh kosong"
                    }
                }
            },
            "nama": {
                validators: {
                    notEmpty: {
                        message: "nama tidak boleh kosong"
                    }
                }
            },
            "harga": {
                validators: {
                    notEmpty: {
                        message: "harga tidak boleh kosong"
                    }
                }
            },
            "uuid_laborat_kategori": {
                validators: {
                    notEmpty: {
                        message: "Kategori tidak boleh kosong"
                    }
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

export {
    defaultValidator, 
    // hargaJualValidator
};
 