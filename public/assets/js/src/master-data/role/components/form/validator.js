const defaultValidator = FormValidation.formValidation(
    $("#form-role")[0],
    {
        fields: {
            "menu": {
                validators: {
                    notEmpty: {
                        message: "Nama menu tidak boleh kosong"
                    }
                }
            },
            "link": {
                validators: {
                    notEmpty: {
                        message: "Link tidak boleh kosong"
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
