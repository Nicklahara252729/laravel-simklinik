class DokterAction{
    constructor(){

    }

    showHideDokterInput = (isDokter) => {
        if(isDokter){
            $('.dokter-container').removeClass('d-none');
            $('.dokter-container').find('select').prop('disabled', false);
        }
        else{
            $('.dokter-container').addClass('d-none');
            $('.dokter-container').find('select').prop('disabled', true);
        }
    }
}

const dokterAction = new DokterAction();
export default dokterAction;