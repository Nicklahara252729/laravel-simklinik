const getProfilData = async () => {
    try{
        const response = await sendApiRequest({
            url : '/api/profil/data',
            type : 'GET',
        }, true)
        return replaceUnderscoresWithHyphens(response.data);
    }
    catch(err){
        console.log(err);
    }
}

const replaceUnderscoresWithHyphens = (obj) => {
    return Object.keys(obj).reduce((acc, key) => {
        const newKey = key.replace(/_/g, '-');
        acc[newKey] = obj[key];
        return acc;
    }, {});
};

const renderProfilData = async (data) => {
    try{
        Object.keys(data).forEach((key) => {
            const elements = document.querySelectorAll(`[data-key="${key}"]`);
            elements.forEach((element) => {
                element.textContent = data[key];
            });
        });

        $("#name-top").text(data.name);
        $("#nama-faskes-top").text(data["nama-faskes"]);
    }
    catch(err){
        console.log(err);
    }
}

const getAllData = async () => {
    try{
        const response = await getProfilData();
        renderProfilData(response);
    }
    catch(err){
        console.log(err);
    }
}

export { getAllData }