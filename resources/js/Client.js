import Glide from "@glidejs/glide";

function init() {
    let slider = document.querySelector('.glide-partners');
    if (slider) {
        var glide = new Glide(slider, {
            type: "carousel",
            perView: 5,
            autoplay: 14000,
            breakpoints: {
                768: {
                    perView: 1,
                },
            },
        });
        glide.mount();
    }
}
export default { init }