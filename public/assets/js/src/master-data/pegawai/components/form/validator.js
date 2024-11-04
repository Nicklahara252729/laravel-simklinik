import {masks, masksOptions} from "./mask.js";

// Pesan kesalahan dalam bahasa Indonesia
const defaultValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            "name": {
                validators: {
                    notEmpty: {
                        message: "Nama lengkap tidak boleh kosong"
                    }
                }
            },
            "email": {
                validators: {
                    notEmpty: {
                        message: "Email tidak boleh kosong"
                    },
                    emailAddress: {
                        message: "Format email tidak valid"
                    }
                }
            },
            "username": {
                validators: {
                    notEmpty: {
                        message: "Username tidak boleh kosong"
                    }
                }
            },
            "level": {
                validators: {
                    notEmpty: {
                        message: "Level tidak boleh kosong"
                    }
                }
            },
            "phone": {
                validators: {
                    notEmpty: {
                        message: "Nomor telepon tidak boleh kosong"
                    },
                    callback: {
                        message: "Nomor telepon tidak valid",
                        callback: function (input) {
                            console.log(input.value)
                            console.log(masksOptions.phone)
                            return Inputmask.isValid(input.value, masksOptions.phone);
                        }
                    }
                }
            },
            "no_npwp": {
                validators: {
                    notEmpty: {
                        message: "Nomor NPWP tidak boleh kosong"
                    },
                    callback: {
                        message: "NPWP tidak valid",
                        callback: function (input) {
                            return Inputmask.isValid(input.value, masksOptions.no_npwp);
                        }
                    }
                }
            },
            "no_str": {
                validators: {
                    notEmpty: {
                        message: "Nomor STR tidak boleh kosong"
                    },
                    callback: {
                        message: "STR tidak valid",
                        callback: function (input) {
                            return Inputmask.isValid(input.value, masksOptions.no_str);
                        }
                    }
                }
            },
            "no_ktp": {
                validators: {
                    notEmpty: {
                        message: "Nomor KTP tidak boleh kosong"
                    },
                    callback: {
                        message: "KTP tidak valid",
                        callback: function (input) {
                            return Inputmask.isValid(input.value, masksOptions.no_ktp);
                        }
                    }
                }
            },
            "tgl_berlaku_str": {
                validators: {
                    notEmpty: {
                        message: "Tanggal berlaku STR tidak boleh kosong"
                    }
                }
            },
            "tgl_berakhir_str": {
                validators: {
                    notEmpty: {
                        message: "Tanggal berakhir STR tidak boleh kosong"
                    }
                }
            },
            "no_sip": {
                validators: {
                    notEmpty: {
                        message: "Nomor SIP tidak boleh kosong"
                    }
                }
            },
            "tgl_berlaku_sip": {
                validators: {
                    notEmpty: {
                        message: "Tanggal berlaku SIP tidak boleh kosong"
                    }
                }
            },
            "tgl_berakhir_sip": {
                validators: {
                    notEmpty: {
                        message: "Tanggal berakhir SIP tidak boleh kosong"
                    }
                }
            },
            "alamat": {
                validators: {
                    notEmpty: {
                        message: "Alamat tidak boleh kosong"
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

const passwordValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            "password": {
                validators: {
                    notEmpty: {
                        message: "Password tidak boleh kosong"
                    },
                    stringLength: {
                        min: 8,
                        message: "Password minimal 8 karakter"
                    }
                }
            },
            "confirm_password": {
                validators: {
                    notEmpty: {
                        message: "Konfirmasi password tidak boleh kosong"
                    },
                    identical: {
                        compare: function () {
                            return $("#form-pegawai input[name='password']").val();
                        },
                        message: "Password tidak sama"
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

const dokterValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            "uuid_spesialis": {
                validators: {
                    notEmpty: {
                        message: "Spesialis tidak boleh kosong"
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

const perawatValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            "uuid_role": {
                validators: {
                    notEmpty: {
                        message: "Ruangan tidak boleh kosong"
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

const kamarValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            kamar: {
                selector : '[data-filter="kamar"]',
                validators: {
                    notEmpty: {
                        message: "Kamar tidak boleh kosong"
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

const poliValidator = FormValidation.formValidation(
    $("#form-pegawai")[0],
    {
        fields: {
            poli: {
                selector : '[data-filter="poli"]',
                validators: {
                    notEmpty: {
                        message: "Poli tidak boleh kosong"
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

export { defaultValidator, passwordValidator, dokterValidator, perawatValidator, kamarValidator, poliValidator }
