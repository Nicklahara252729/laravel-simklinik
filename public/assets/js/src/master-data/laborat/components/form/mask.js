class Mask {
    constructor() {
        this.maskOptions = {
            harga : {
                "alias": "numeric",
                "groupSeparator": ".",
                "autoGroup": true,
                // "digits": 0,
                // "digitsOptional": false,
                // "placeholder": "0",
                "rightAlign": false,
                // "autoUnmask" : true
            },
        }

        this.masks = {
            harga : Inputmask(
                this.maskOptions.harga
            ).mask($("input[name='harga']")),
        }
    }
}

const mask = new Mask();
const masks = mask.masks;
const masksOptions = mask.maskOptions
export { masks, masksOptions};
