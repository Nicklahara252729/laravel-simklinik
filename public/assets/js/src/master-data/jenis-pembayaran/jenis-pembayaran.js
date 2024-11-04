import { getAllData } from "./process/read.js";
import { createEvents } from "./process/create.js";
import { deleteEvent } from "./process/delete.js";
import { editEvents } from "./process/edit.js";

$(document).ready(async () => {
    getAllData()
    createEvents()
    deleteEvent()
    editEvents()
})