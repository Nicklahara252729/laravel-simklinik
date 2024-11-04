class Mask {
    constructor() {
        this.maskOptions = {
            phone : {
                "mask" : "9999-9999-9999[9]"
            },
        }

        this.masks =     {
            phone : Inputmask(
                this.maskOptions.phone
            ).mask($("input[name='phone']")),
        }
    }
}

const mask = new Mask();
const masks = mask.masks;
const maskOptions = mask.maskOptions;

export {masks, maskOptions};
