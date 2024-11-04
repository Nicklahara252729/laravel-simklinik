const defaultValidator = FormValidation.formValidation(
    $("#form-tindakan-kategori")[0],
    {
        fields: {
            "kategori": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong"
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
