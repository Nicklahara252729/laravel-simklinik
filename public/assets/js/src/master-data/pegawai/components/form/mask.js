class Mask {
    constructor() {
        this.maskOptions = {
            phone : {
                "mask" : "9999-9999-999[9][9]"
            },
            no_ktp : {
                "mask" : "9999999999999999"
            },
            no_str : {
                "mask" : "99 99 9 9 9 99-9999999"
            },
            no_npwp : {
                "mask" : "99.999.999.9-999.999"
            }
        }

        this.masks = {
            phone : Inputmask(
                this.maskOptions.phone
            ).mask($("input[name='phone']")),
            no_ktp : Inputmask(
                this.maskOptions.no_ktp
            ).mask($("input[name='no_ktp']")),
            no_str : Inputmask(
                this.maskOptions.no_str
            ).mask($("input[name='no_str']")),
            no_npwp : Inputmask(
                this.maskOptions.no_npwp
            ).mask($("input[name='no_npwp']"))
        }
    }
}

const mask = new Mask();
const masks = mask.masks;
const masksOptions = mask.maskOptions
export { masks, masksOptions};
