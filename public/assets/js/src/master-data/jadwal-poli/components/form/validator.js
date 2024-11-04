const defaultValidator = FormValidation.formValidation(
    $("#form-jadwal-poli")[0],
    {
        fields: {
            "uuid_poliklinik": {
                validators: {
                    notEmpty: {
                        message: "Poliklinik tidak boleh kosong"
                    }
                }
            },
            "dokter": {
                validators: {
                    notEmpty: {
                        message: "Dokter tidak boleh kosong"
                    }
                }
            },
            "perawat": {
                validators: {
                    notEmpty: {
                        message: "Perawat tidak boleh kosong"
                    }
                }
            },
            "hari": {
                validators: {
                    notEmpty: {
                        message: "Hari tidak boleh kosong"
                    }
                }
            },
            startHour: {
                selector : '[data-validator="start-hour"]',
                validators: {
                    notEmpty: {
                        message: "Jam mulai tidak boleh kosong"
                    }
                }
            },
            endHour: {
                selector : '[data-validator="end-hour"]',
                validators: {
                    notEmpty: {
                        message: "Jam berakhir tidak boleh kosong"
                    }
                }
            },
            "kode_antrian": {
                validators: {
                    notEmpty: {
                        message: "Kode antrian tidak boleh kosong"
                    }
                }
            },
            "keterangan": {
                validators: {
                    notEmpty: {
                        message: "Keterangan tidak boleh kosong"
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
