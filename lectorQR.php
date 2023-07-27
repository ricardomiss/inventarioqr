<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector de codigo QR</title>
    <!-- Estilos de CSS -->
    <link rel="stylesheet" href="assets/styles/lectorQR.css">
    <link rel="stylesheet" href="assets/styles/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,800&family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/807171747a.js" crossorigin="anonymous"></script>
</head>
<body>
    <style>

        .qrHerramientasTwo input {
            height: 30px;
            width: 90%;
            margin: auto;
            margin: 10px;
            border-radius: 5px;
            color: #000;
            border: 1px solid #BDBDBD;
        }
        
        .container-notas {
            width: 100%;
            height: auto;
            position: relative;
            display: block; /* Pasar a display: block */
        }
        
        .containerhijo2 h4 { /* Acabo de modificar */
            text-align: center;
            font-size: 18px;
            margin-bottom: 50px;
            font-weight: 900;
        }
        
        .qrTrabajadorOner input { /* Acabo de agregar */
            width: 80%;
            border-radius: 5px;
            border: 2px solid #BDBDBD;
            padding: 10px;
            margin: 10px auto;
            display: block;
        }
        
        #buttonSeguro {
            display: none;
        }
    </style>


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
        <!-- Seccion principal -->

        <section class="container-one">
            <div class="text-descripcion">
                <h1>Autorizar prestamo de herramientas</h1>

                <p>
                    Por favor, asegúrese de que el empleado tenga el código QR generado por 
                    la empresa antes de iniciar el proceso de préstamo.
                </p>
            </div>

            <div class="portada-img">
                <img src="assets/img/Teamwork-sinfonfo.png" alt="">
            </div>

            <div class="button-emergente">
                <button id="myButton">Iniciar proceso</button>
            </div>
        </section>
    
        <!-- Seccion de los prestamos en proceso -->

        <section class="container-two">
            <div class="container-proceso">
                <h2><i class="fa-solid fa-calendar-days"></i> Prestamos en proceso</h2>
                <?php
                #Incluir la coniexion de la BD
                include("conexion_bd.php");
                include("registro.php");
                #Por cada fila que encuentre en la tabla herramientas, se va a crear una lista con los datos de la herramienta
                foreach ($conexion->query('SELECT * from prestamo') as $row) {
                    $id = $row['idprestamo'];
                    $idtrabajador = $row['idtrabajador'];
                    foreach ($conexion->query("SELECT * from trabajadores WHERE id = '$idtrabajador'") as $row1) {
                        $nombretrabajador = $row1['nombre'];
                        $numerotrabajador = $row1['telefono'];
                        $correotrabajador = $row1['correo'];
                        $puestotrabajador = $row1['puesto'];
                        $fechatrabajador = $row1['fecha_registro'];
                    }
                    $idherramienta = $row['idherramienta'];
                    foreach ($conexion->query("SELECT * from herramientas WHERE id = '$idherramienta'") as $row2) {
                        $nombreherramienta = $row2['nombre'];
                        $colorherramienta = $row2['color'];
                        $tipoherramienta = $row2['tipo'];
                    }
                    $idprestamo = $row['idprestamo'];
                    $fecha1 = $row['fechaprestamo'];
                    $fecha2= $row['fechafinalizacion'];
                    $cantidad = $row['cantidad']
                ?>
                <div class="container-notas"><!-- Pasar a display: block; -->
                    <div class="container-cards"><!--container-cards -->
                        <div class="container-infUser">
                            <div class="title-user">
                                <!-- Meter los datos de la BD en <em> -->
                                <p>Nombre:<em><?php echo $nombretrabajador?></em></p>
                                <p>Fecha del prestamo: <em><?php echo $fecha1?></em></p>
                                <p>Fecha de finalizacion: <em><?php echo $fecha2?></em></p>
                            </div>

                            <details>
                                <summary>Mas informacion del trabajador</summary>
                                <article>
                        <!-- Los datos los meteras en <em> -->
                                    <p>ID: <em><?php echo $idtrabajador?></em></p>
                                    <p>Numero telefonico: <em><?php echo $numerotrabajador?></em></p>
                                    <p>Correo electronico: <em><?php echo $correotrabajador?></em></p>
                                </article>
                            </details>

                            <details>
                                <summary>Herramientas solicitadas</summary>
                                <article class="article-flex">
                    <!-- Meter los divs de ls bd en la clase .article-flex -->
                                    <div class="CC-tool">
                                        <ul>
                                    <!-- Los datos los meteras en <em> -->
                                            <li>Nombre: <em><?php echo $nombreherramienta?></em></li>
                                            <li>ID: <em><?php echo $idherramienta?></em></li>
                                            <li>Cantidad: <em><?php echo $cantidad?></em></li>
                                        </ul>
                                    </div>
                                </article>
                            </details>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $idprestamo ?>">
                                <input name="prestamo_delete" type="submit" value="Eliminar prestamo en proceso">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </section>

        <!-- Codigo de la ventana emergente -->

        <section class="popup">
            <div class="container-Cerrar">
                <button id="buttonCerrar"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <!-- Contenedor de la camara y informacion del solicitante -->
            <div class="container-padre"> <!-- Con estilo -->
                <div class="container-oneUL"> <!-- Con estilo -->

                    <div class="containerprincipal"> <!-- Con estilo -->
                      <div class="containerprincipalhijo"> <!-- Con estilo -->
                        <h1>Lector de codigo QR</h1>
                        <video id="preview" onclick="scanner.start();"></video>
                        <p>Sugerencias</p>

                        <ul>
                            <li>Por favor, escanee primero el código QR del trabajador.</li>
                            <li>Asegúrese de limpiar la cámara antes de escanear.</li>
                            <li>Por favor, asegúrese de encontrarse en un lugar con buena iluminación para poder escanear correctamente el código QR</li>
                        </ul>
                      </div>

                      <!-- Informacion del solicitante  -->

                      <div class="containerhijo2">
                        <h4>Información del empleado que solicita herramientas</h4>

                        <!-- Contenedor de trabajador vacio -->
                        <div class="containervacio" style="display: none;">
                            <img src="assets/img/imgOne-Tools.png" alt="">

                            <p>
                                No hay informacion que mostrar, escanee el codigo QR del trabajador
                            </p>
                        </div>

                        <div class="qrTrabajadorOner">
                            <form id="formOfi" method="post">
                                <input type="date" name="prestamo-date">
                                <input name="button_prestamo" type="submit" value="Confirmar prestamos">
                            </form>
                        </div>
                        <div class="require-text">
                            
                            <!-- <button id="buttoConfirmar">Confirmar prestamo</button> -->
                            <form>
                                <input type="date" name="prestamo-date">
                                <input name="button_prestamo" type="submit" value="Enviar formularios">
                            </form>
                        </div>
                      </div>
                   </div>
                </div>
        
                    <div class="user-info">    
                        <div class="container-procesoOne">
                            <h3>Informacion de la solicitud del prestamo</h3>
                        </div>

                      <div class="desplazamiento">
                        <div class="container-trabajador">
                            <h4>Herramientas solicitadas</h4>
                            <div class="qrHerramientasTwo">
                                
                                <input id="cantidadTool" style="display: none;" placeholder="Introduzca Cantidad" type="text">
                                <button id="buttondelete" style="display: none;">Eliminar</button>

                                
                                <div class="containerSeguro">
                                    <b id="buttonSeguro">Confirmar herramientas</butto>
                                </div>
                            
                            </div>
                        </div>  
                      </div>
                      <div class="container-vacio2">
                        <img src="assets/img/imgSegundo.png" alt="">

                        <p>
                            No hay informacion que mostrar, escanee el codigo QR del trabajador
                        </p>
                    </div>

                    </div>

                    <div class="containerblanco">

                    </div>
            </div>
        </section>
    </main>

      <!-- Archivos de JavaScript -->
      <script src="assets/scripts/jquery.min.js"></script>
      <script src="assets/scripts/instascan.min.js"></script>

<script>
    const preview = document.getElementById("preview");
    const qrTrabajadorOner = document.querySelector('.qrTrabajadorOner');
    const qrHerramientasTwo = document.querySelector(".qrHerramientasTwo");
    const requireText = document.querySelector(".require-text");
    const containerVacio = document.querySelector(".containervacio");
    const containerVacio2 = document.querySelector(".container-vacio2");
    const successMessage = document.createElement("div");
    const errorMessage = document.createElement("div");

    const confirmMessage = document.createElement("div");
    const noToolsMessage = document.createElement("div");
    
    confirmMessage.textContent = "Herramientas confirmadas";
    noToolsMessage.textContent = "Agregue herramientas para confirmar";

    successMessage.textContent = "Escaneado con éxito";
    errorMessage.textContent = "El código ya fue escaneado anteriormente";
    
    function showMessage(messageElement) {
        messageElement.style.display = "block";
        setTimeout(() => {
            messageElement.style.display = "none";
        }, 5000);
    }
    
    [successMessage, errorMessage].forEach((messageElement) => {
        messageElement.style.display = "none";
        messageElement.style.position = "fixed";
        messageElement.style.top = "90%";
        messageElement.style.left = "50%";
        messageElement.style.transform = "translate(-50%, -50%)";
        messageElement.style.backgroundColor = "#183153";
        messageElement.style.color = "white";
        messageElement.style.padding = "10px 20px";
        messageElement.style.borderRadius = "5px";
        document.body.appendChild(messageElement);
    });
    
    errorMessage.style.backgroundColor = "#d9534f";
    
    [confirmMessage, noToolsMessage].forEach((messageElement) => {
        messageElement.style.display = "none";
        messageElement.style.position = "fixed";
        messageElement.style.top = "90%";
        messageElement.style.left = "50%";
        messageElement.style.transform = "translate(-50%, -50%)";
        messageElement.style.backgroundColor = "#183153";
        messageElement.style.color = "white";
        messageElement.style.padding = "10px 20px";
        messageElement.style.borderRadius = "5px";
        document.body.appendChild(messageElement);
    });
    
    noToolsMessage.style.backgroundColor = "#d9534f";
    
    function deleteList(event) {
        const button = event.target;
        const ul = button.parentElement;
        const listContainer = ul.parentElement;

        // Obtener el contenido del código QR que se está eliminando
        const codigoQR = form.textContent.trim().split('\n')[0];

        // Eliminar el elemento del array de códigos escaneados
        const index = codigosEscaneados.indexOf(codigoQR);
        if (index !== -1) {
            codigosEscaneados.splice(index, 1);
        }
        
        listContainer.remove(); // Cambiar a 'remove()' en lugar de agregar la clase 'deleted' y ocultarlo
    }
    
    let scanner = new Instascan.Scanner({
        video: preview,
        mirror: false,
        backgroundScan: false,
        captureImage: false,
        scanPeriod: 1,
        videoConstraints: {
            width: { ideal: 256 },
            height: { ideal: 144 },
            facingMode: "environment"
        }
    });
    
    let primerCodigo = "";//Ocupo
    let codigosEscaneados = [];
    let contador = 0
    scanner.addListener("scan", function (content) {
        
        if (codigosEscaneados.includes(content)) {
            showMessage(errorMessage);
            return;
        }

        codigosEscaneados.push(content);

        let list = document.getElementById("formOfi"); //Acabo de modificar
        let li4 = document.createElement("input");
        let items = content.split(" | ");
        
        items.forEach((item) => { //Funcion para mete los datos a los li
            let li = document.createElement("input"); //Acabo de modificar
            let li2 = document.createElement("input"); //Acabo de modificar
            let li3 = document.createElement("hr")

            li.setAttribute("value", item);
            li.setAttribute("name", `data-text${contador}`)
            li.setAttribute("type", "text");
            li.textContent = item;
            list.appendChild(li);
            

           if(contador > 0) {
                li2.setAttribute("placeholder", "Ingrese la cantidad de herramientas");
                li2.setAttribute("name", `cantidad-tool${contador}`);
                li2.setAttribute("type", "text");
                list.appendChild(li2);           
            }

            list.appendChild(li3)
            contador++
        });
        li4.setAttribute("value", contador - 1);
        li4.setAttribute("name", "contador");
        li4.setAttribute("type", "hidden");
        list.appendChild(li4);
        
    });
    

        Instascan.Camera.getCameras()
        .then(function (cameras) {
            if (cameras.length > 0) {
            scanner.start(cameras[0]);
            } else {
            console.error("La camara no funciona");
            }
        })
        .catch(function (e) {
            console.error(e);
        });

        const buttonSeguro = document.getElementById("buttonSeguro");

        buttonSeguro.addEventListener("click", function () {
            // Verifica si hay códigos QR de herramientas escaneados en pantalla
            const herramientasEscaneadas = qrHerramientasTwo.querySelectorAll(".list-container");
        
            // Comprueba si hay más de un código QR escaneado y si hay herramientas escaneadas en pantalla
            if (codigosEscaneados.length > 1 && herramientasEscaneadas.length > 0) {
            showMessage(confirmMessage);
            } else {
            showMessage(noToolsMessage);
            }
        });
        
        // Codigo para la ventana emergente
        function openPopup() {
        
        if (scanner.active) {
            scanner.stop(); // Detener la cámara
        }

        var popup = document.createElement("div");
        popup.className = "popup";

        popup.innerHTML = "Este es el contenido de la ventana emergente.";

        document.body.appendChild(popup);
        }

        const myButton = document.getElementById('myButton');
        const popup = document.querySelector('.popup');

        myButton.addEventListener('click', function() {

        popup.style.display = 'block';
        });

        //Boton cerrar 
        const buttonCerrar = document.getElementById('buttonCerrar');
        buttonCerrar.addEventListener('click', cerrarPopup);

        function cerrarPopup() {
        const popup = document.querySelector('.popup');
        popup.style.display = 'none';
        
        if (scanner.active) {
            scanner.start(scanner.camera); // Iniciar la cámara de nuevo
        }
    }
    
function enviarFormularios() {
  const forms = document.querySelectorAll(".container-data");
  const promises = [];

  forms.forEach((form) => {
    const formData = new FormData(form);
    const url = form.action;

    promises.push(fetch(url, { method: "POST", body: formData }));
  });

  Promise.all(promises)
    .then(() => {
      console.log("Todos los formularios han sido enviados");
    })
    .catch((error) => {
      console.error("Error al enviar el formulario", error);
    });
}

</script>
</body>
</html>