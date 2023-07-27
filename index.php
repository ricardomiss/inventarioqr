<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión </title>
    <!-- Estilos css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,800&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/login.css">
    <link rel="stylesheet" href="assets/styles/normalize.css">
</head>
<body>

    <main>
        <div class="container">
            <div class="title">
                <h1>Iniciar Sesión</h1>
                <h2>¡Bienvenido!</h2>
            </div>
            <!-- action="procesar-login.php" -->
            <?php
            include("conexion_bd.php");
            include("login.php");
            ?>
            <div class="forms">
                <h3>Ingrese sus datos</h3>
                <form  id="login-form" method="post">
                    <input name="username" type="email" id="username" placeholder="Correo electronico...">
                    <input name="password" type="password" id="password" placeholder="Contraseña...">
                    <input name="iniciar" class="btn" type="submit" Value="Iniciar Sesion">
                </form>

                <div class="informacion">
                    <p class="element">ToolsInc |</p>
                    <p>Ayuda</p>
                    <p>Privacidad</p>
                    <p>Condiciones</p>
                </div>
            </div>
        </div>
    </main>

    <!-- <div class="conta">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium non eveniet ipsum quam id dolorum pariatur tempore consequuntur nemo assumenda odit harum qui, excepturi deserunt velit repellat! Excepturi, odit odio?</p>
    </div> -->

    <!-- Scripts -->
    <!--<script src="assets/scripts/login.js"></script>-->
</body>
</html>