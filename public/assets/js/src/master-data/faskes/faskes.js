import { getAllData } from "./process/read.js";
import { deleteEvents } from "./process/delete.js";
import { createEvents } from "./process/create.js";
import { editEvents } from "./process/edit.js"

$(document).ready(async () => {
    // request api function
    getAllData()
    createEvents()
    deleteEvents()
    editEvents()

    $('.dropify').dropify(dropfiyConfig);    
})
