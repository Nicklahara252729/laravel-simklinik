const defaultValidator = FormValidation.formValidation(
    $("#form-satuan-obat")[0],
    {
        fields: {
            "satuan": {
                validators: {
                    notEmpty: {
                        message: "Nama satuan tidak boleh kosong"
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
