let container = document.querySelector(".contenedor"),
    qrInputs = document.querySelectorAll(".form input"),
    boton = document.querySelector("button"),
    qrimg = document.querySelector("img"),
    img = document.querySelector(".qr_code img");

boton.addEventListener("click", () => {
    let qrvalue = "";
    let inputValues = {};

    qrInputs.forEach(input => {
        const inputId = input.getAttribute("id");
        const inputValue = input.value.replace(/\s+/g, " ");
        if (input.getAttribute("name") !== "enviar") { // Excluir el input con el nombre "enviar"
            inputValues[inputId] = inputValue;
        }
    });

    Object.entries(inputValues).forEach(([id, value]) => {
        qrvalue += `${value} | `;
    });

    qrvalue = qrvalue.slice(0, -3); // Eliminar el último separador |
    qrvalue += " \n";

    if (!qrvalue) return;
    boton.innerHTML = "Generando codigo QR...";
    qrimg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrvalue}`;

    qrimg.addEventListener("load", () => {
        container.classList.add("active");
        boton.innerHTML = "Generar codigo QR";

        let imgPath = qrimg.getAttribute("src");
        let nombreArchivo = getFileName();
        
        fetch(imgPath)
        .then((response) => response.blob())
        .then((blob) => {
            saveAs(blob, nombreArchivo + ".png");
      });
    });
});

qrInputs = document.querySelectorAll(".form input");
qrInputs = Array.from(qrInputs); // Convertir a array

qrInputs.forEach(input => {
    input.addEventListener("keyup", () => {
        if (qrInputs.some(input => input.value)) {
            container.classList.remove("active");
        }
    });
});

// ... (resto del código)

boton.addEventListener("click", () => {
    let descargar = document.querySelector("#descargar");
    descargar.addEventListener("click", () => {
        let imgPath = img.getAttribute("src");
        let nombreArchivo = getFileName();

        // Convertir la imagen en Blob y guardarla como PNG
        fetch(imgPath)
            .then((response) => response.blob())
            .then((blob) => {
                saveAs(blob, nombreArchivo + ".png");
            });
    });
});

function getFileName() {
    // Obtener el valor del campo de entrada del nombre del tra
    const nombreHerramienta = document.getElementById("Nombre-Herramienta").value;

    // Reemplazar cualquier caracter no permitido en nombres de archivo con guiones bajos
    const nombreArchivo = nombreHerramienta.replace(/[^a-zA-Z0-9\s-]/g, '_');

    return nombreArchivo;
}