<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen de herramientas</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="assets/styles/almacen.css">
    <link rel="stylesheet" href="assets/styles/normalize.css">
    <script src="https://kit.fontawesome.com/807171747a.js" crossorigin="anonymous"></script>
</head>
<body>
    <style>
         .container-list {
            width: 90%;
            height: auto;
            display: block;
            position: relative;
            margin: 20px auto;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0px 0px 10px 0px #424242;
        }

        .container-list li {
            list-style: none;
            font-size: 18px;
            width: 100%;
            height: auto;
        }
        
        .container-list .windowPop-up, .windowPop-up1 {
            width: 250px;
            margin: 10px 0px 0px 15px;
            display: inline-block;
            background: #1D2B3A;
            border: none;
            color: #FFFFFF;
            font-size: 18px;
            padding: 8px;
            border-radius: 5px;
        }

        form {
            display: inline-block;
        }
        
        .container-list .delate-data {
            width: 250px;
            margin: 10px 0px 0px 15px;
            display: inline-block;
            background: #B71C1C;
            border: none;
            color: #FFFFFF;
            font-size: 18px;
            padding: 8px;
            border-radius: 5px;
        }
        
        .popup, .popup2 {
            border-radius: 10px;
            width: 50%;
            height: 80vh;
            background: #FFFFFF;
            position: absolute;
            z-index: 100;
            display: none;
            box-shadow: 0px 0px 10px 6px #E0E0E0;
        }

        .container-cerrar {
            background-color: #E0E0E0;
            position: relative;
        }
        
        .closeWindows {
            margin: 10px 0px 10px 95%;
        }
        
        .container-form {
            width: 98%;
            margin: auto;
            position: relative;
        }
        
        .form {
            width: 100%;
        }

        .form input {
            width: 90%;
            margin: 5px auto;
            display: block;
            height: 30px;
            border: none;
            color: #1D2B3A;
            background: #E0E0E0;
        }

        .form label {
            color: #424242;
            margin-left: 30px;
        }

        .container-text h3 {
            text-align: center;
        }

        .btn-dowload, .btn-dowload2 {
            width: 95%;
            display: block;
            font-size: 18px;
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #FFFFFF;
            background: #607D8B;
        }
        
         .container-busqueda {
            margin-top: 90px;
            width: 100%;
            height: 60px;
            z-index: 100;
            display: flex;
            background: #FFFFFF;
            position: fixed;
            align-items: center;
            justify-content: center;
        }

        #inputId, #inputIdDos{
            height: 28px;
            padding-left: 10px;
            border-radius: 5px;
            width: 300px;
            border: 2px solid #E0E0E0;
        }
        
        .container-father {
            margin-top: 150px;
            position: fixed;
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
    
     <div class="container-busqueda">
        <div class="container-busquedaOne">
            <input type="text" id="inputId" placeholder="Ingrese un ID">
            <button id="searchButton">Buscar</button>
        </div>
    </div>
    
    <div class="container-father">
        <div class="container-tool">
            <h2>Herramientas</h2>
            <?php
            #Incluir la coniexion de la BD
            include("conexion_bd.php");
            include("registro.php");
            #Por cada fila que encuentre en la tabla herramientas, se va a crear una lista con los datos de la herramienta
            foreach ($conexion->query('SELECT * from herramientas') as $row) { ?>
            <!-- Los datos son introducidos en el HTML y los echo con php -->
                <div class="container-list">
                    <ul>
                        <?php $id = $row['id']; ?>
                        <li id="<?php echo $row['nombre'];?>">Nombre: <em><?php echo $row['nombre'] ?></em></li>
                        <li id="<?php echo $id?>" >ID: <em><?php echo $id ?></em></li>
                        <li id="<?php echo $row['color'];?>">Color: <em><?php echo $row['color'] ?></em></li>
                        <li id="<?php echo $row['tipo'];?>">Tipo: <em><?php echo $row['tipo'] ?></em></li>
                        <li id="<?php echo $row['fecha'];?>">Fecha: <em><?php echo $row['fecha'] ?></em></li>
                        <li id="<?php echo $row['descripcion'];?>">Descripcion: <em><?php echo $row['descripcion'] ?></em></li>
                    </ul>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input class="delate-data" name="borrar" type="submit" value="Eliminar Datos"/>
                    </form>
                    <button class="windowPop-up">Editar Informacion</button>
                    <button class="btn-dowload" onclick="descargar('<?php echo $id ?>','<?php echo $row['nombre']?>')" ><i class="fa-solid fa-image"></i>&nbsp;&nbspDescargar codigo QR</button>

                </div>
                <?php
                }
                if (array_key_exists('borrar', $_POST)) {
                    $id = $_POST['id'];
                    borrar($id, $conexion);
                }
                
                ?>


            <div class="containercards-tool">
                <div class="cardstool"> <!-- Pasar a display: block; -->
                    <ul>
                        <!-- Los datos los meteras en <em> -->
                        <li>Nombre: <em></em></li>
                        <li>ID: <em></em></li>
                        <li>Color: <em></em></li>
                        <li>Tipo: <em></em></li>
                        <li>Fecha: <em></em></li>
                    </ul>

                    <details>
                        <summary>Descripcion de la herramienta</summary>
                        <article>
                            <!-- Meter descripcion en la etiqueta <p> -->
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium sapiente temporibus molestias veniam repellat, culpa beatae voluptatibus! Unde culpa rem, aut perspiciatis sequi repellat doloremque minima debitis eos mollitia porro!</p>
                        </article>
                    </details>

                    <button>Eliminar herramienta</button>
                    
                </div>    
            </div>
        </div>
        
        <!-- Ventana Emergente -->
        <div class="popup">
            <div class="container-cerrar">
                <button class="closeWindows"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="container-form">
                    <form method="post" class="form">
                        
                        <div class="container-text">
                            <h3>Modificar los datos de la herramienta</h3>
                        </div>
                        
                        <label for="ID-Herramienta">ID de la herramienta</label>
                        <input name="id_tool" autocomplete="off" pattern="^[a-zA-Z0-9]{10}$" title="Por favor ingrese solo letras y números. Debe tener exactamente 10 caracteres."  required id="ID-Herramienta" type="text" placeholder="Coloque el ID de la herramienta" readonly value="">
        
                        <label for="Nombre-Herramienta">Modificar el nombre de la herramienta</label>
                        <input name="name_tool" autocomplete="off" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras. Máximo 50 caracteres." required id="Nombre-Herramienta" type="text" placeholder="Coloque el nombre de la herramienta"value="">
                        
                        <label for="Color-Herramienta">Modificar el color de la herramienta</label>
                        <input name="color_tool" autocomplete="off" pattern="[a-zA-Z\s]{1,30}" title="Solo se permiten letras y espacios"  required id="Color-Herramienta" type="text" placeholder="Coloque el color de la herramienta"value="">
                        
                        <label for="Tipo-Herramienta">Modificar el tipo de herramienta</label>
                        <input name="type_tool" autocomplete="off" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras. Máximo 50 caracteres."   required id="Tipo-Herramienta" type="text" placeholder="Coloque el tipo de herramienta"value="">
                        
                        <label for="Fecha-Herramienta">Fecha de registro</label>
                        <input name="date_tool" autocomplete="off" max="2023-12-31" title="La fecha no puede ser mayor al año 2023"  required id="Fecha-Herramienta" type="date" placeholder="0" value="">
        
                        <label for="descripcion_herramienta">Modificar la descripcion de la herramienta</label>
                        <input name="description_tool" autocomplete="off"  title="La descripcion no puede ser mayor a 300 caracteres"  required id="description_tool1" type="text" value="">
                        <input name="actualizar" class="btn" type="submit" Value="Modificar datos">
                </form>
                
            </div>
        </div>
        
        <div class="container-trabajador">
            <h2>Trabajadores</h2>
            <?php
            foreach ($conexion->query('SELECT * from trabajadores') as $row) {?>
                <div class="container-list">
                    <ul>
                        <?php $id = $row['id']; ?>
                        <li id="<?php echo $row['nombre'];?>">Nombre: <em><?php echo $row['nombre']?></em></li>
                        <li id="<?php echo $id?>" >ID: <em><?php echo $row['id']?></em></li>
                        <li id="<?php echo $row['telefono'];?>">Telefono: <em><?php echo $row['telefono']?></em></li>
                        <li id="<?php echo $row['correo'];?>">Correo: <em><?php echo $row['correo']?></em></li>
                        <li id="<?php echo $row['fecha_registro'];?>">Fecha: <em><?php echo $row['fecha_registro']?></em></li>
                        <li id="<?php echo $row['puesto']?>">Puesto de trabajo: <em><?php echo $row['puesto']?></em></li>
                    </ul>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input class="delate-data" name="borrar1" type="submit" value="Eliminar Datos"/>
                    </form>
                    <button class="windowPop-up1">Editar Informacion</button>
                    <button class="btn-dowload2" onclick="descargar('<?php echo $id ?>','<?php echo $row['nombre']?>')"><i class="fa-solid fa-image"></i>&nbsp;&nbspDescargar codigo QR</button>

                </div>
                <?php
                }
                if (array_key_exists('borrar1', $_POST)) {
                    $id = $_POST['id'];
                    borrar1($id, $conexion);
                }
                ?>

            <div class="containercard-trabajadores">
                <div class="cardstrabajadores"> <!-- Display: none; a block -->
        <!-- Los datos los meteras en <em> -->
                    <ul>
                        <li>Nombre: <em></em></li>
                        <li>ID: <em></em></li>
                        <li>Telefono: <em></em></li>
                        <li>Correo: <em></em></li>
                        <li>Fecha: <em></em></li>
                        <li>Puesto de trabajo: <em></em></li>
                    </ul>

                    <button>Eliminar trabajador</button>
                </div>
            </div>
        </div>
        
          <!-- Ventana Emergente -->
          <div class="popup2">
            <div class="container-cerrar">
                <button class="closeWindows"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="container-form">
                <form method="post" class="form">

                    <div class="container-text">
                        <h3>Modificar los datos de los trabajadores</h3>
                    </div>
                    <label for="id_trabajador">ID del trabajador</label>
                    <input name="id_worker" autocomplete="nope" pattern="^[a-zA-Z0-9]{12}$" title="Ingrese solo letras y números, debe tener exactamente 12 caracteres."  required id="id_trabajador" type="text" placeholder="Ingrese el ID del trabajador" readonly>
    
                    <label for="id_nombreTrabajador">Modificar el nombre</label>
                    <input name="name_worker" autocomplete="nope" pattern="^[a-zA-Z\s]{1,50}$" title="Por favor ingrese solo letras y un máximo 50 caracteres." required id="id_nombreTrabajador" type="text" placeholder="Ingrese el nombre">
    
                    <label for="id_telefonoTrabajador">Modificar el teléfono</label>
                    <input name="phone_worker" autocomplete="nope" title="Por favor ingrese exactamente 10 dígitos"  type="tel" id="id_telefonoTrabajador" placeholder="Ingrese el numero telefonico" required >
    
                    <label for="id_emailTrabajador">Modificar correo electrónico</label>
                    <input name="email_worker" autocomplete="nope" type="email" placeholder="Ingrese correo electrónico" required id="id_emailTrabajador">
    
                    <label for="Fecha-Herramienta">Fecha de registro</label>
                    <input name="date_worker" autocomplete="off" max="2023-12-31" title="La fecha no puede ser mayor al año 2023"  required id="Fecha-Herramienta" type="date" placeholder="0">
    
                    <label for="">Modificar el puesto del trabajo</label>
                    <input name="work_worker" autocomplete="nope" pattern="^[a-zA-Z0-9\s]{1,50}$" title="Ingrese solo letras y numero, solo 50 caracteres" type="text" id="puesto_trabajador" required  placeholder="Ingrese el puesto del trabajador">
                    <input name="actualizar2" class="btn" type="submit" Value="Modificar datos">
                    <?php
                    
                    
                    ?>
                </form>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/gh/eligrey/FileSaver.js/src/FileSaver.js"></script>
    <script src="assets/scripts/filesaver.js"></script>
<script>
     function openPopup() {
        const popup = document.createElement("div");
        popup.className = "popup";
        popup.innerHTML = "Este es el contenido de la ventana emergente.";
        document.body.appendChild(popup);
    }
    
    const myButtons1 = document.querySelectorAll('.windowPop-up');
    
    for (let i = 0; i < myButtons1.length; i++) {
        myButtons1[i].addEventListener('click', function() {
            const container = this.parentNode;
            //Selecciona el li de acuerdo a su pocision
            const li = container.querySelector('li[id]:nth-of-type(2)');
            const li2 = container.querySelector('li[id]:nth-of-type(1)');
            const li3 = container.querySelector('li[id]:nth-of-type(3)');
            const li4 = container.querySelector('li[id]:nth-of-type(4)');
            const li5 = container.querySelector('li[id]:nth-of-type(5)');
            const li6 = container.querySelector('li[id]:nth-of-type(6)');

            //Obtiene el valor del atributo
            const id = li.getAttribute('id');
            const id2 = li2.getAttribute('id');
            const id3 = li3.getAttribute('id');
            const id4 = li4.getAttribute('id');
            const id5 = li5.getAttribute('id');
            const id6 = li6.getAttribute('id');

            //Selecciona los inputs y los almacena en la variable 
            const idToolInput = document.querySelector('input[name="id_tool"]');
            const idToolInput2 = document.querySelector('input[name="name_tool"]');
            const idToolInput3 = document.querySelector('input[name="color_tool"]');
            const idToolInput4 = document.querySelector('input[name="type_tool"]');
            const idToolInput5 = document.querySelector('input[name="date_tool"]');
            const idToolInput6 = document.querySelector('input[name="description_tool"]');


            //Agrega el valor de los id como value en los inputs
            idToolInput.value = id;
            idToolInput2.value = id2;
            idToolInput3.value = id3;
            idToolInput4.value = id4;
            idToolInput5.value = id5;
            idToolInput6.value = id6;

            const popup = document.querySelector('.popup');
            popup.style.display = 'block';
        });
    }

    
    // Primer botón cerrar
    const buttonsCerrar = document.querySelectorAll('.closeWindows');
    
    buttonsCerrar.forEach(button => {
        button.addEventListener('click', cerrarPopup1);
    });
    
    function cerrarPopup1() {
        const popup = document.querySelector('.popup');
        popup.style.display = 'none';
    }

// //Segunda ventana emergente 

    function openPopup2() {
        const popup = document.createElement("div");
        popup.className = "popup2";
        popup.innerHTML = "Este es el contenido de la ventana emergente.";
        document.body.appendChild(popup);
    }
    
    const myButtons2 = document.querySelectorAll('.windowPop-up1');
    
    for (let i = 0; i < myButtons2.length; i++) {
        myButtons2[i].addEventListener('click', function() {
            const container = this.parentNode;

            //Selecciona el li de acuerdo a su pocision
            const li = container.querySelector('li[id]:nth-of-type(2)');
            const li2 = container.querySelector('li[id]:nth-of-type(1)');
            const li3 = container.querySelector('li[id]:nth-of-type(3)');
            const li4 = container.querySelector('li[id]:nth-of-type(4)');
            const li5 = container.querySelector('li[id]:nth-of-type(5)');
            const li6 = container.querySelector('li[id]:nth-of-type(6)');

            //Obtiene el valor del atributo
            const id = li.getAttribute('id');
            const id2 = li2.getAttribute('id');
            const id3 = li3.getAttribute('id');
            const id4 = li4.getAttribute('id');
            const id5 = li5.getAttribute('id');
            const id6 = li6.getAttribute('id');

            //Selecciona los inputs y los almacena en la variable 
            const idToolInput = document.querySelector('input[name="id_worker"]');
            const idToolInput2 = document.querySelector('input[name="name_worker"]');
            const idToolInput3 = document.querySelector('input[name="phone_worker"]');
            const idToolInput4 = document.querySelector('input[name="email_worker"]');
            const idToolInput5 = document.querySelector('input[name="date_worker"');
            const idToolInput6 = document.querySelector('input[name="work_worker"]');

            //Agrega el valor de los id como value en los inputs
            idToolInput.value = id;
            idToolInput2.value = id2;
            idToolInput3.value = id3;
            idToolInput4.value = id4;
            idToolInput5.value = id5;
            idToolInput6.value = id6;

            const popup = document.querySelector('.popup2');
            popup.style.display = 'block';
        });
    }
    
    // Primer botón cerrar
    const buttonsCerrar2 = document.querySelectorAll('.closeWindows');
    
    buttonsCerrar2.forEach(button => {
        button.addEventListener('click', cerrarPopup);
    });
    
    function cerrarPopup() {
        const popup = document.querySelector('.popup2');
        popup.style.display = 'none';
    }
    function descargar(id,nombre) {
        qrvalue = id;
        url = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrvalue}`;
    
        descargarImagen(url,nombre);
    }
    
    function descargarImagen(url,nombre) {
        fetch(url)
            .then((response) => response.blob())
            .then((blob) => {
                const urlBlob = URL.createObjectURL(blob);
                const anchor = document.createElement("a");
                anchor.href = urlBlob;
                anchor.download = `${nombre}.png`;
                anchor.click();
                URL.revokeObjectURL(urlBlob);
            });
    }
    
    
    const searchButton = document.getElementById('searchButton');
    
    searchButton.addEventListener('click', function() {
      const searchId = inputId.value;
      const listItem = document.getElementById(searchId);
    
      if (listItem) {
        const container = listItem.parentNode.parentNode; // Acceder al contenedor padre del li
        const parentContainer = container.parentNode; // Acceder al contenedor padre del contenedor
    
        parentContainer.prepend(container); // Mover el contenedor al principio del contenedor padre
      }
    });




</script>

</body>
</html>