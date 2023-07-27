<?php
if(!empty($_POST["iniciar"])){
    #Verifica de que los campos no esten vacios dando un alert
    if(empty($_POST["username"]) || empty($_POST["password"])){
        echo '<script language="javascript">alert("Please enter your username and password");</script>';
    }else{
        #variables donde se guardan los datos del usuario y contraseña
        $usuario=$_POST["username"];
        $contra=$_POST["password"];
        #se hace la consulta a la BD para ver si el usuario y contraseña son correctos
        $sql=$conexion->query("SELECT * FROM usuarios WHERE nombre='$usuario' AND contrasena='$contra'");
        #si son correctos se redirecciona a la pagina de QRHerramientas.php
        if($datos=$sql->fetch_object()){
            echo'<script type="text/javascript">window.location.href="bienvenida.html";</script>';
            #header("location: QRHerramientas.php");
            #exit;
        }else{
            #si no son correctos se muestra un alert
            echo '<script language="javascript">alert("Incorrect username or password");</script>';
        }
    }
    
}
?>