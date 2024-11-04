const defaultValidator = FormValidation.formValidation(
    $("#form-pengguna")[0],
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
            "phone": {
                validators: {
                    notEmpty: {
                        message: "Nomor telepon tidak boleh kosong"
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
    $("#form-pengguna")[0],
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
                            return $("#form-pengguna input[name='password']").val();
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

export { defaultValidator, passwordValidator };