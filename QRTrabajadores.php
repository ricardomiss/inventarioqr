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
        <!-- <div class="container">
                <div>
                    <img src="assets/img/newLogo01.png" alt="">
                    <p>ToolsInc</p>
                </div>
        </div> -->
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
                    <h4>Ingrese los datos de los trabajadores</h4>
                </div>

                <label for="id_trabajador">Ingresar el ID</label>
                <input name="id_worker"autocomplete="nope" pattern="^[a-zA-Z0-9]{12}$" title="Ingrese solo letras y números, debe tener exactamente 12 caracteres."  required id="id_trabajador" type="text" placeholder="Ingrese el ID del trabajador">

                <label for="id_nombreTrabajador">Ingresar el nombre</label>
                <input class="excluido" name="name_worker" autocomplete="nope" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras y un máximo 50 caracteres." required id="id_nombreTrabajador" type="text" placeholder="Ingrese el nombre">

                <label for="id_telefonoTrabajador">Ingresar el teléfono</label>
                <input class="excluido" name="phone_worker" autocomplete="nope" title="Por favor ingrese exactamente 10 dígitos"  type="tel" id="id_telefonoTrabajador" placeholder="Ingrese el numero telefonico" required oninput="this.value = this.value.replace(/[^\d\s]/g,''); if ((this.value.match(/\d/g) || []).length => 10) { this.setCustomValidity('Por favor ingrese exactamente 10 dígitos (los espacios no se cuentan)'); } else { this.setCustomValidity(''); }">

                <label for="id_emailTrabajador">Ingresar correo electrónico</label>
                <input class="excluido" name="email_worker" autocomplete="nope" type="email" placeholder="Ingrese correo electrónico" required id="id_emailTrabajador">

                <label for="Fecha-Herramienta">Fecha de registro</label>
                <input class="excluido" name="date_worker" autocomplete="off" max="2023-12-31" title="La fecha no puede ser mayor al año 2023"  required id="Fecha-Herramienta" type="date" placeholder="0">

                <label for="">Ingrese el puesto del trabajo</label>
                <input class="excluido" name="work_worker" autocomplete="nope" pattern="^[a-zA-Z0-9\s]{1,50}$" title="Ingrese solo letras y numero, solo 50 caracteres" type="text" id="puesto_trabajador" required  placeholder="Ingrese el puesto del trabajador">
                <input class="excluido" name="enviar1" class="btn" type="submit" Value="Enviar Datos">
            </form>

            <div class="qr_code">
                <img class="imgOpen" src="assets/img/img_QR.jpg" alt="">
                
                <button class="btn-QR" id="descargar">Descargar codigo QR</button>
            </div>
        </section>
    </main>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/eligrey/FileSaver.js/src/FileSaver.js"></script>
    <script src="assets/scripts/filesaver.js"></script>
    <script src="assets/scripts/QRTrabajador.js"></script>
    
</body>
</html>