<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seccion de registro</title>
    <!-- Hojas de estilo -->
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link rel="stylesheet" href="assets/styles/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,800&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/QRHerramientas.css">
    <script src="https://kit.fontawesome.com/807171747a.js" crossorigin="anonymous"></script>
 
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><i class="fa-solid fa-house"></i><a href="lectorQR.php">Autorización de prestamos</a></li>
                <li><i class="fa-solid fa-file-circle-plus"></i><a href="QRHerramientas.php">Registro de herramientas</a></li>
                <li><i class="fa-solid fa-users-viewfinder"></i><a href="QRTrabajadores.php">Registro de trabajadores</a></li>
                <li><i class="fa-solid fa-box-archive"></i><a href="almacen.php">Almacen</a></li>
                <!-- <li><i class="fa-sharp fa-solid fa-clock"></i><a href="historial.php">Historial</a></li> -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="contenedor">
            <?php
            include("conexion_bd.php");
            include("registro.php");
            ?>
            <form method="post" class="form">

                <div class="container-text">
                    <h3>Generador de codigo QR</h3>
                    <h4>Ingrese los datos de la herramienta</h4>
                </div>
                
                <label for="ID-Herramienta">Escriba el ID de la herramienta</label>
                <input name="id_tool" pattern="^[a-zA-Z0-9]{10}$" title="Por favor ingrese solo letras y números. Debe tener exactamente 10 caracteres."  required id="ID-Herramienta" type="text" placeholder="Coloque el ID de la herramienta">
                
                <!-- <label for="ID-Empleado">Escriba el ID del empleado</label>
                <input pattern="^[a-zA-Z0-9]{10}$" title="Por favor ingrese solo letras y números. Debe tener exactamente 10 caracteres."  required id="ID-Empleado" type="text" placeholder="Coloque el ID del empleado"> -->

                <label for="Nombre-Herramienta">Escriba el nombre de la herramienta</label>
                <input class="excluido" name="name_tool" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras. Máximo 50 caracteres." required id="Nombre-Herramienta" type="text" placeholder="Coloque el nombre de la herramienta">
                
                <label for="Color-Herramienta">Escriba el color de la herramienta</label>
                <input class="excluido" name="color_tool" pattern="[a-zA-Z\s]{1,30}" title="Solo se permiten letras y espacios"  required id="Color-Herramienta" type="text" placeholder="Coloque el color de la herramienta">
                
                <label for="Tipo-Herramienta">Escriba el tipo de herramienta</label>
                <input class="excluido" name="type_tool" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras. Máximo 50 caracteres."   required id="Tipo-Herramienta" type="text" placeholder="Coloque el tipo de herramienta">
                
                <!-- <label for="descripcion">Escriba una breve descripción</label>
                <input pattern="^[a-zA-Z0-9\s]{1,250}$" title="Por favor ingrese solo letras y números. Debe tener maximo 250 caracteres." name="descripcion_herramienta" required id="descripcion" type="text" placeholder="Coloque una breve descripcion"> -->
                
                <label for="Fecha-Herramienta">Fecha de registro</label>
                <input class="excluido" name="date_tool" max="2023-12-31" title="La fecha no puede ser mayor al año 2023"  required id="Fecha-Herramienta" type="date" placeholder="0">

                <label for="descripcion_herramienta">Escriba la descripcion de la herramienta</label>
                <input class="excluido" name="description_tool"  title="La descripcion no puede ser mayor a 300 caracteres"  required id="description_tool1" type="text">
                <input class="excluido" name="enviar" class="btn" type="submit" Value="Enviar Datos">

                </form>

            <div class="qr_code">
                <img class="imgOpen" src="assets/img/img_QR.jpg" alt="">
                
                <button class="btn-QR" id="descargar">Descargar codigo QR</button>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/gh/eligrey/FileSaver.js/src/FileSaver.js"></script>
    <script src="assets/scripts/filesaver.js"></script>

<script>
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
        if (input.getAttribute("class") !== "excluido") { // Excluir el input con el nombre "enviar"
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

</script>
    
</body>
</html>