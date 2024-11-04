/**
 * Process login
 */
const sendLogin = async () => {
    const formData = new FormData($('#kt_sign_in_form')[0]);

    try {
        const response = await sendApiRequest({
            url: '/api/auth/login',
            data: formData,
            type: 'POST',
        }, false);

        if (response.status === "OK") {
            setUserData(response.data); // Set user data including token, name, level, and photo
            swalSuccessLogin('Berhasil login, Selamat datang!');
            // Additional handling if needed for successful login
        } else {
            swalError(response.message, () => {});
        }
    } catch (error) {
        const { responseJSON } = error;
        const message = error instanceof ReferenceError ? error.message : responseJSON.message;
        if(message){
            swalError(`${message}`, () => {});
        }
        else{
            console.error(error);
        }
    }
};

// Define form element
const form = document.getElementById('kt_sign_in_form');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'username': {
                validators: {
                    notEmpty: {
                        message: 'Username input is required'
                    }
                }
            },
            'password': {
                validators: {
                    notEmpty: {
                        message: 'Password input is required'
                    }
                }
            },
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    }
);

const init = () => {
    $('#kt_sign_in_submit').on('click', async (event) => {
        event.preventDefault();
        if (validator) {
            validator.validate().then(async function (status) {
                console.log('validated!');
                if (status == 'Valid') {
                    await sendLogin();
                }
            });
        }
    });
};

export { init };