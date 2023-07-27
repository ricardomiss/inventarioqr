let container = document.querySelector(".contenedor"),
    qrInput = document.querySelector(".form input"),
    qrInput2 = document.querySelector(".form #input2")
    boton = document.querySelector(".form button"),
    qrimg = document.querySelector(".qr_code img"),
    descargar = document.querySelector("#descargar"),
    img = document.querySelector("img");

boton.addEventListener("click", () => {
    let qrvalue = qrInput.value + qrInput2.value;

    if(!qrvalue) return;
        boton.innerHTML = "Generando codigo QR...";
        qrimg.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrvalue}`;

    qrimg.addEventListener("Load", () => {
        container.classList.add("active");
        boton.innerHTML = "Generar codigo QR";
    })
});

qrInput.addEventListener("keyup", () => {
    if (qrInput.value) {
        container.classList.remove("active");
    }
});

qrInput2.addEventListener("keyup", () => {
    if (qrInput.value) {
        container.classList.remove("active");
    }
});


descargar.addEventListener("click", () => {
    let imgPath = img.getAttribute("src");
    let nombreArchivo = getFileName(imgPath);

   saveAs(imgPath, nombreArchivo);
});

function getFileName(str) {
   return str.substr(str.lastIndexOf('/') + 1);
};