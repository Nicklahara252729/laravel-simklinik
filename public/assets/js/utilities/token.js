/**
 * set access token and user data as HTTPOnly cookies using js-cookie
 */
const setUserData = (userData, expired) => {
  const { token } = userData;

  Cookies.set('Bearer', token, {
    secure: true,
    sameSite: 'none',
    expires: expired,
  });

  // Cookies.set('user_name', name, {
  //   expires: expired,
  // });

  // Cookies.set('user_level', level, {
  //   expires: expired,
  // });

  // Cookies.set('user_photo', photo, {
  //   expires: expired,
  // });
};

/**
 * get access token from cookies using js-cookie
 */
const getAccessToken = () => {
  return Cookies.get('Bearer');
};

/**
 * get user data from cookies using js-cookie
 */
const getUserData = () => {
  return {
    // name: Cookies.get('user_name'),
    // level: Cookies.get('user_level'),
    // photo: Cookies.get('user_photo'),
  };
};

/**
 * remove access token and user data cookies using js-cookie
 */
const removeUserData = () => {
  Cookies.remove('Bearer', { secure: true, sameSite: 'none' });
  // Cookies.remove('user_name');
  // Cookies.remove('user_level');
  // Cookies.remove('user_photo');
};

/**
 * refresh access token and user data
 */
const refreshAccessTokenAndUserData = async () => {
  try {
    const response = await fetch('/api/token/refresh', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${getAccessToken()}`,
      },
      credentials: 'include', // Send cookies for cross-origin requests
    });

    if (response.ok) {
      const newUserData = await response.json();
      console.log(newUserData);
      setUserData(newUserData.data); // Set the new token and user data as cookies
      return newUserData.data;
    } else {
      throw new Error('Failed to refresh access token');
    }
  } catch (error) {
    throw error;
  }
};
