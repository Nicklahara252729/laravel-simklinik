import { getAllData } from "./process/read.js"
import { detailInit } from "./process/detail.js";

$(document).ready(async () => {
    if (window.localStorage) {
        if (!localStorage.getItem('refresh')) {
        localStorage['refresh'] = true;
        location.reload(true);
        } else {
        localStorage.removeItem('refresh');
        }
    }

    // request api function
    getAllData()

    detailInit()
})

window.speechSynthesis.onvoiceschanged = function(e) {
    speechSynthesis.getVoices();
};