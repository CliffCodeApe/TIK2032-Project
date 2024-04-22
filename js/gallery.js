// Image Editting
let contrast = document.getElementById("contrast");
let saturation = document.getElementById("saturation");
let brightness = document.getElementById("brightness");
let sepia = document.getElementById("sepia")
let invert = document.getElementById("invert")
let hue = document.getElementById("hue")

let contrastVal = contrast.value;
let saturateVal = saturation.value;
let brightnessVal = brightness.value / 100;
let sepiaVal = sepia.value;
let invertVal = invert.value;
let hueVal = (hue.value / 100) * 360;

let images = document.getElementsByClassName("image");
let imagesArray = [...images]

let controls = document.getElementById("controls")
let edit = document.getElementById("edit")
let close = document.getElementById("close")
let reset = document.getElementById("reset")

edit.addEventListener("click", () => {
    controls.style.display="flex"
    edit.style.display="none"
    close.style.display="block"
    reset.style.display="block"
})

close.addEventListener("click", () => {
    controls.style.display="none"
    edit.style.display="block"
    close.style.display="none"
    reset.style.display="none"
})

function imageFilter(img){
    img.style.filter=`contrast(${contrastVal}%) saturate(${saturateVal}%) brightness(${brightnessVal}) sepia(${sepiaVal}%) invert(${invertVal}%) hue-rotate(${hueVal}deg)`
}

contrast.addEventListener('input', () => {
    contrastVal = contrast.value;
    imagesArray.forEach(image => {imageFilter(image)});
})

saturation.addEventListener('input', () => {
    saturateVal = saturation.value;
    imagesArray.forEach(image => {imageFilter(image)});
})

brightness.addEventListener('input', () => {
    brightnessVal = brightness.value / 100;
    imagesArray.forEach(image => {imageFilter(image)});
})

sepia.addEventListener('input', () => {
    sepiaVal = sepia.value;
    imagesArray.forEach(image => {imageFilter(image)});
})

invert.addEventListener('input', () => {
    invertVal = invert.value;
    imagesArray.forEach(image => {imageFilter(image)});
})

hue.addEventListener('input', () => {
    hueVal = (hue.value / 100) * 360;
    imagesArray.forEach(image => {imageFilter(image)});
})

reset.addEventListener("click", () => {
    contrast.value = 100;
    brightness.value = 100;
    saturation.value = 100;
    sepia.value = 0;
    invert.value = 0;
    hue.value = 0;

    contrast.dispatchEvent(new Event('input'))
    brightness.dispatchEvent(new Event('input'))
    saturation.dispatchEvent(new Event('input'))
    sepia.dispatchEvent(new Event('input'))
    invert.dispatchEvent(new Event('input'))
    hue.dispatchEvent(new Event('input'))
})


imagesArray.forEach(image => {imageFilter(image)});

// Image Popup
let popups = document.querySelector(".popup");
let popImg = document.querySelector('.popup img')
let x = document.querySelector('.popup span')
imagesArray.forEach(e => {
    e.addEventListener("click", () => {
        popups.style.display = 'block'
        popImg.src = e.getAttribute('src')
        imageFilter(popImg)
    })
});

x.addEventListener("click", () => {popups.style.display = 'none'})