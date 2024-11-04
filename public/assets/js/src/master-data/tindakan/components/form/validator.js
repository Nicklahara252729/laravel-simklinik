const defaultValidator = FormValidation.formValidation(
    $("#form-tindakan")[0],
    {
        fields: {
            "kode": {
                validators: {
                    notEmpty: {
                        message: "Kode tidak boleh kosong"
                    }
                }
            },
            "nama": {
                validators: {
                    notEmpty: {
                        message: "nama tidak boleh kosong"
                    }
                }
            },
            "harga": {
                validators: {
                    notEmpty: {
                        message: "harga tidak boleh kosong"
                    }
                }
            },
            "uuid_tindakan_kategori": {
                validators: {
                    notEmpty: {
                        message: "Kategori tidak boleh kosong"
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

// const hargaJualValidator = FormValidation.formValidation(
//     $("#form-tindakan-harga-jual")[0],
//     {
//         fields: {
//             "uuid_jenis_pembayaran[]": {
//                 validators: {
//                     notEmpty: {
//                         message: "Jenis pembayaran tidak boleh kosong"
//                     }
//                 }
//             },
//             "harga_jual[]": {
//                 validators: {
//                     notEmpty: {
//                         message: "Harga jual tidak boleh kosong"
//                     }
//                 }
//             }
//         },

//         plugins: {
//             trigger: new FormValidation.plugins.Trigger(),
//             bootstrap: new FormValidation.plugins.Bootstrap5({
//                 rowSelector: ".fv-row",
//                 eleInvalidClass: "",
//                 eleValidClass: ""
//             })
//         }
//     }
// );

export {
    defaultValidator, 
    // hargaJualValidator
};
 