/**
 * Redirect based on access token and page meta
 */
const redirectBasedOnToken = () => {
    const page = document.querySelector('meta[name="page"]').content;
    const accessToken = getAccessToken();
    
    if (!accessToken && page === 'panel') {
        window.location = '/';
    } else if (accessToken && page === 'auth') {
        window.location = '/dashboard';
    }
};

window.onload = redirectBasedOnToken;
