class Validator {
    constructor(form){
        this.validator = FormValidation.formValidation(
            form[0],
            {
                fields: {
                    'jenis_pembayaran': {
                        validators: {
                            notEmpty: {
                                message: 'Nama tidak boleh kosong'
                            }
                        }
                    },
                },
        
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );
    }
}

export {Validator}