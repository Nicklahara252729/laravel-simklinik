const defaultValidator = FormValidation.formValidation(
    $("#form-diagnosa")[0],
    {
        fields: {
            "code": {
                validators: {
                    notEmpty: {
                        message: "Kode tidak boleh kosong"
                    }
                }
            },
            "diagnosa": {
                validators: {
                    notEmpty: {
                        message: "Nama diagnosa tidak boleh kosong"
                    }
                }
            },
            deskripsi: {
                selector : '[data-validator="deskripsi"]',
                validators: {
                    notEmpty: {
                        message: "Deskripsi tidak boleh kosong"
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

export default defaultValidator;
