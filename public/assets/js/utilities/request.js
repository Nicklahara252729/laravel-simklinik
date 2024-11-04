/**
 * Sets authorization headers in the provided options object.
 *
 * @param {Object} options - The options object to which headers will be added.
 */
const setAuthorizationHeader = (options) => {
    const headers = options.headers || {};
    options.headers = {
        ...headers,
        // signature: `${getSignature()}`,
        Authorization: `Bearer ${getAccessToken()}`
    };
};

/**
 * Handles unauthenticated errors by refreshing the access token and reattempting the API request.
 *
 * @param {Object} options - The options object containing the API request configuration.
 * @returns {Promise} A Promise that resolves with the API response after handling unauthenticated errors.
 */
const handleUnauthenticatedError = async (options) => {
    const newAccessToken = await refreshAccessToken();
    setAccessToken(newAccessToken.authorization.token);
    const newOptions = { ...options };
    setAuthorizationHeader(newOptions);
    return $.ajax(newOptions);
};

/**
 * Sends an API request with optional authorization
 *
 * @param {Object} options - The options object containing the API request configuration.
 * @param {boolean} authorize - Indicates whether the request needs authorization headers.
 * @returns {Promise} A Promise that resolves with the API response.
 * @throws Will throw an error if the API request fails.
 */
const sendApiRequest = async (options, authorize = false) => {
    try {
        // if (!authorize) {
        //     // Remove access token from request headers if authorization is not needed
        //     // const headers = options.headers || {};
        //     // delete headers.Authorization;
        //     // options.headers = headers;
        // }

        const { type } = options;
        let newOptions = type.toUpperCase() === 'POST' || type.toUpperCase() === 'PUT'
            ? { ...options, processData: false, contentType: false }
            : { ...options };

        if (authorize) {
            setAuthorizationHeader(newOptions);
        }

        const response = await $.ajax(newOptions);

        return response;
    } catch (error) {
        const { responseJSON } = error;
        if (error.status === 401 && responseJSON?.message === 'Unauthenticated.') {
            // Handle 401 error if needed
        } else {
            throw error;
        }
    }
};
