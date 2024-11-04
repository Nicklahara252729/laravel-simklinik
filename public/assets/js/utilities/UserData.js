class UserData{
    constructor(){
        this.userDataResponse = null;
        this.userData = async () => {
            try {
                return this.userDataResponse
            }
            catch(error){
                console.error(error);
                throw error;
            }
        };

        this.getUserData().then((userData) => {
            this.userDataResponse = userData;
        })
    }

    getUserData = async () => {
        try{
            const userData = await sendApiRequest({
                url: `/api/profil/data`,
                type: "GET",
            }, true)
            const { name, photo, level } = userData.data;
            return { name, photo, level };
        }
        catch(error){
            console.error(error);
            throw error;
        }
    }
}

const userDataInstance = new UserData();
const userData = userDataInstance.userData;