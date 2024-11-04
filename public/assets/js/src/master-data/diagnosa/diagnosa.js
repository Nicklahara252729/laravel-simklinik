import { getAllData } from "./process/read.js";
import { createEvents } from "./process/create.js";
import { deleteEvent } from "./process/delete.js";
import { editEvents } from "./process/edit.js";

/**
 * Initializes the Diagnosa management functionality when the document is ready.
 *
 * @function
 * @async
 * @listens document#ready
 */
$(document).ready(async () => {
    // Fetch and render all Diagnosa data
    getAllData();

    // Set up event listeners for creating, deleting, and editing Diagnosa data
    createEvents();
    deleteEvent();
    editEvents();
});
