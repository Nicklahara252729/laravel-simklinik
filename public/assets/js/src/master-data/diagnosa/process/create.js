import { ModalInput } from "../components/modal/modal.js";

/**
 * Initializes event listener for opening the create modal to add a new diagnosa.
 */
const createEvents = () => {
    /**
     * Event listener for opening the create modal to add a new diagnosa.
     *
     * @event click
     * @listens #open-create-modal
     */
    $('#open-create-modal').on('click', () => {
        const diagnosaModalHandler = new ModalInput();
        
        // Call the modal add handler function to open the create modal
        diagnosaModalHandler.modalAddHandler();
    });
};

export { createEvents };
