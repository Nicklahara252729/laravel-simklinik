const defaultValidator = FormValidation.formValidation(
    $("#form-faskes")[0],
    {
        fields: {
            "nama": {
                validators: {
                    notEmpty: {
                        message: "Nama tidak boleh kosong."
                    }
                }
            },
            "kode": {
                validators: {
                    notEmpty: {
                        message: "Kode faskes tidak boleh kosong."
                    }
                }
            },
            "no_faskes": {
                validators: {
                    notEmpty: {
                        message: "Nomor faskes tidak boleh kosong."
                    }
                }
            },
            "uuid_user": {
                validators: {
                    notEmpty: {
                        message: "Kepala faskes tidak boleh kosong."
                    }
                }
            },
            "id_provinsi": {
                validators: {
                    notEmpty: {
                        message: "Provinsi tidak boleh kosong."
                    }
                }
            },
            "id_kabupaten": {
                validators: {
                    notEmpty: {
                        message: "Kabupaten kategori tidak boleh kosong."
                    }
                }
            },
            "id_kecamatan": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong."
                    }
                }
            },
            "id_desa": {
                validators: {
                    notEmpty: {
                        message: "Nama kategori tidak boleh kosong."
                    }
                }
            },
            "counter_kk": {
                validators: {
                    notEmpty: {
                        message: "Counter KK tidak boleh kosong."
                    }
                }
            },
            "counter_pasien": {
                validators: {
                    notEmpty: {
                        message: "Counter Pasien tidak boleh kosong."
                    }
                }
            },
            "latitude": {
                validators: {
                    notEmpty: {
                        message: "Latitude tidak boleh kosong."
                    }
                }
            },
            "longitude": {
                validators: {
                    notEmpty: {
                        message: "Longitude tidak boleh kosong."
                    }
                }
            },
            "alamat": {
                validators: {
                    notEmpty: {
                        message: "Alamat tidak boleh kosong."
                    }
                }
            },
            "kode_pos": {
                validators: {
                    notEmpty: {
                        message: "Kode pos tidak boleh kosong."
                    }
                }
            },
            poliklinik: {
                selector: '[data-filter="poliklinik"]',
                validators: {
                    notEmpty: {
                        message: "Poliklinik tidak boleh kosong."
                    }
                }
            },
            jenis_pembayaran: {
                selector: '[data-filter="jenis_pembayaran"]',
                validators: {
                    notEmpty: {
                        message: "Jenis pembayaran tidak boleh kosong."
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
