import Glide from "@glidejs/glide";

function init() {
    let slider = document.querySelector('.glide');
    if (slider) {
        var glide = new Glide(slider, {
            type: slider,
            rewind: true,
            gap: 0,
            bound: true,
            autoplay: 2800,
            // autoplay: false,
        });
        glide.mount();
    }
}
export default { init }