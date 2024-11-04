
const defaultValidator = FormValidation.formValidation(
    $("#form-petugas-poli")[0],
    {
        fields: {
            "uuid_user": {
                validators: {
                    notEmpty: {
                        message: "Nama pegawai tidak boleh kosong"
                    }
                }
            },
            "uuid_poliklinik": {
                validators: {
                    notEmpty: {
                        message: "Poliklinik tidak boleh kosong"
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
