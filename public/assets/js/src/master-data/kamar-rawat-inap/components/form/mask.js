class Mask {
    constructor() {
        this.maskOptions = {
            harga : {
                "alias": "numeric",
                "groupSeparator": ".",
                "rightAlign": false,
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
