const defaultValidator = FormValidation.formValidation(
    $("#form-klasifikasi-obat")[0],
    {
        fields: {
            "klasifikasi": {
                validators: {
                    notEmpty: {
                        message: "Nama klasifikasi tidak boleh kosong"
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
