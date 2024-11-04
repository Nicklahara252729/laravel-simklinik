const capitalizeFirstLetter = (str) => {
    // Check if the input is a non-empty string
    if (typeof str !== "string" || str.length === 0) {
        return str;
    }

    // Split the input string into words
    const words = str.split(" ");

    // Capitalize the first letter of each word and join them back into a string
    const capitalizedWords = words.map((word) => {
        // Capitalize the first letter of the word and concatenate it with the rest of the word
        return word.charAt(0).toUpperCase() + word.slice(1);
    });

    // Join the capitalized words into a single string
    return capitalizedWords.join(" ");
};

const dropfiyConfig = {
    messages: {
        default: "Tarik dan lepaskan foto atau klik disini",
        replace: "Tarik dan lepaskan atau klik untuk mengubah",
        remove: "Hapus",
        error: "Ooops, ada sedikit kesalahan :(",
    },
    error: {
        fileSize: "File terlalu besar ({{ value }} max).",
        minWidth: "Ukuran lebar foto terlalu kecil ({{ value }}}px min).",
        maxWidth: "Ukuran lebar foto terlalu besar ({{ value }}}px max).",
        minHeight: "Ukuran tinggi foto terlalu kecil ({{ value }}}px min).",
        maxHeight: "Ukuran tinggi foto terlalu besar ({{ value }}px max).",
        imageFormat:
            "Format tidak diperbolehkan, hanya ({{ value }} yang di perbolehkan ).",
        fileExtension:
            "Format tidak diperbolehkan, hanya ({{ value }} yang di perbolehkan ).",
    },
    tpl: {
        wrap: '<div class="dropify-wrapper" style="border-radius:10px"></div>',
        message:
            '<div class="dropify-message"><span class="file-icon" /> <p style="font-size:2rem">{{ default }}</p></div>',
        preview:
            '<div class="dropify-preview"><span class="dropify-render" style="border-radius:10px;"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
    },
};

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
const validator = FormValidation.formValidation($("#form-ubah-password")[0], {
    fields: {
        current_password: {
            validators: {
                notEmpty: {
                    message: "Password lama tidak boleh kosong",
                },
            },
        },
        password: {
            validators: {
                notEmpty: {
                    message: "Password baru tidak boleh kosong",
                },
                callback: {
                    callback: function (input) {
                        if (input.value.length < 8) {
                            return {
                                valid: false,
                                message:
                                    "Password tidak boleh lebih kurang dari 8 karakter",
                            };
                        } else {
                            return true;
                        }
                    },
                },
            },
        },
        password_confirmation: {
            validators: {
                notEmpty: {
                    message: "Konfirmasi password tidak boleh kosong",
                },
                identical: {
                    compare: function () {
                        return $('[name="password"]').val();
                    },
                    message: "Password tidak sama",
                },
            },
        },
    },

    plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap5({
            rowSelector: ".fv-row",
            eleInvalidClass: "",
            eleValidClass: "",
        }),
    },
});

const changePasswordRequest = async () => {
    try {
        const data = new FormData($("#form-ubah-password")[0]);
        data.append("_method", "PUT");
        console.log(data);
        const response = await sendApiRequest(
            {
                url: "/api/profil/reset-password",
                type: "POST",
                data: data,
            },
            true
        );
        return response;
    } catch (e) {
        //check if error on response 422
        console.log(e);
        if (e.status === 422) {
            const errorFields = e.responseJSON.errors;
            const errorMessage = Object.entries(errorFields)
                .map(([field, errors]) =>
                    errors.map(
                        (error) =>
                            `<li style="text-align: left">${field}: ${error}</li>`
                    )
                )
                .flat()
                .join("\n");
            swalError(`Validasi Error: <ul>${errorMessage}</ul>`, () => {});
        } else {
            const errorMessage =
                e.responseJSON && e.responseJSON.message
                    ? e.responseJSON.message
                    : "Oops, Something error :(";
            swalError(errorMessage, () => {});
        }
    }
};

$("#submit-ubah-password").on("click", function (e) {
    e.preventDefault();
    if (validator) {
        validator.validate().then(async function (status) {
            if (status === "Valid") {
                const response = await changePasswordRequest();
                if(response){
                    swalSuccess(response.message, async () => {
                        $("#modal-ubah-password").modal("hide");
                    });
                }
            }
        });
    }
});

const formatIDR = (number) => `Rp. ${number.toLocaleString("id-ID")}`;

const parseIDR = (formattedString) => {
    // Remove "Rp." and non-numeric characters and parse as an integer
    return parseInt(formattedString.replace(/[^\d]/g, ''), 10);
};
