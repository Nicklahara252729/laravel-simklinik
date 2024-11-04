
class ValidatorObat {
    constructor(form){
        this.validator = FormValidation.formValidation(
            form[0],
            {
                fields: {
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'harga_satuan': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'harga_beli': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'harga_beli': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'uuid_satuan_obat': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'uuid_klasifikasi_obat': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'jenis': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'tgl_expired': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'no_batch': {
                        validators: {
                            notEmpty: {
                                message: 'Text input is required'
                            }
                        }
                    },
                    'uuid_jenis_pembayaran[]': {
                        validators: {
                            notEmpty: {
                                message: 'Pilih jenis pembayaran'
                            }
                        }
                    },
                    'harga_jual[]': {
                        validators: {
                            notEmpty: {
                                message: 'Masukan harga jual'
                            }
                        }
                    }
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

export { ValidatorObat }