/**
 * process logout
 */
const sendLogout = async () => {
    try {
        const response = await sendApiRequest({
            url: '/api/auth/logout',
            type: 'POST',
        }, true);
        if(response.status) {
            removeUserData(); // Remove user data along with the access token
            window.location = "/";
        }
        else{
            swalError(`${response.message}`)
        }
    } catch (error) {
        const { responseJSON } = error;
        const message = error instanceof ReferenceError ? error.message : responseJSON.message;
        swalError(`${message}`)
    }
}

/**
 * logout process
 */
const initiateLogout = () => {
    swalLogoutConfirm(msgConfirmLogout, () => {
        sendLogout(); // Trigger logout upon confirmation
    });
};

$('#btn_sign_out').on('click', (event) => {
    event.preventDefault();
    initiateLogout();
});

$('#sign_out_navbar').on('click', (event) => {
    event.preventDefault();
    initiateLogout();
});