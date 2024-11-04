import { getDataRole } from "../../../role/process/read.js";

class PerawatAction{
    constructor(){
        $("#role").on('change', this.roleHandler);

        this.showHideInput($('.kamar-access'), false, true);
        this.showHideInput($('.poli-access'), false, true);

        this.renderRoleOptions();
    }

    renderRoleOptions = async () => {
        const data = await getDataRole();
        const availableRoles = ['Pasien IGD', 'Apotek', 'Poliklinik', 'Management Kamar'];
        
        // Filter data for the desired menu items
        const filteredData = data.filter(item => availableRoles.includes(item.menu));
    
        // Generate HTML options for filtered menu items
        const optionsHTML = filteredData.map(item => {
            return `<option value="${item.uuid_role}" data-name="${item.menu}">${item.menu}</option>`;
        }).join('');
    
        $("#role").append(optionsHTML);
    }

    showHideInput = (inputEl, active, isSelect = false) => {
        //show and enable the input if active
        const inputType = isSelect ? 'select' : 'input';
        if(active){
            inputEl.removeClass('d-none');
            inputEl.find(inputType).prop('disabled', false);
        }
        //hide and disable the input if not active
        else{
            inputEl.addClass('d-none');
            inputEl.find(inputType).prop('disabled', true);
        }
    }

    showPerawatInput = (isPerawat) => {
        this.showHideInput($('.perawat-input'), isPerawat, true);
    }

    roleHandler = async (e) => {
        const roleValue = e.target.value;
        const role = e.target.selectedOptions[0].dataset.name;


        this.showHideInput($('.kamar-access'), role === 'Management Kamar', true)
        this.showHideInput($('.poli-access'), role === 'Poliklinik', true)
    }

    fillData = (data) => {
        const { kamar: kamars = [], poliklinik: polikliniks = [] } = data;
        if(kamars.length){
            $('#kamar-access').val(kamars.map(item => item.uuid_kamar)).trigger('change');
        }

        if(polikliniks.length){
            $('#poli-access').val(polikliniks.map(item => item.uuid_poliklinik_link_klinik)).trigger('change');
        }
    }
}

const perawatAction = new PerawatAction();
export default perawatAction;