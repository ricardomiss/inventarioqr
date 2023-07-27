<?php
#Registro de herramientas
if(!empty($_POST["enviar"])){
    $idherramienta = $_POST["id_tool"];
    $nombreherramienta = $_POST["name_tool"];
    $colorherramienta = $_POST["color_tool"];
    $tipodeherramienta = $_POST["type_tool"];
    $fechadeherramienta = $_POST["date_tool"];
    $descripcionherramienta = $_POST["description_tool"];
    $query = $conexion->query("SELECT id FROM herramientas WHERE id = '$idherramienta'");
    if($query->num_rows > 0){
        echo "<script>alert('El id de esa herramienta ya existe, intente con otro id');</script>";
        echo "<script>history.go(-1);</script>";
    }else{
        $sql=$conexion->query("INSERT INTO herramientas (id, nombre, color, tipo, fecha, descripcion) VALUES ('$idherramienta', '$nombreherramienta', '$colorherramienta', '$tipodeherramienta', '$fechadeherramienta', '$descripcionherramienta')"); 
    }
       
}
#Registro de trabajadores
if(!empty($_POST["enviar1"])){
    $idtrabajador = $_POST["id_worker"];
    $nombretrabajador = $_POST["name_worker"];
    $telefonotrabajador = $_POST["phone_worker"];
    $correotrabajador = $_POST["email_worker"];
    $fechatrabajador = $_POST["date_worker"];
    $puestotrabajador = $_POST["work_worker"];
    $query = $conexion->query("SELECT id FROM trabajadores WHERE id = '$idtrabajador'");
    if($query->num_rows > 0){
        echo "<script>alert('El id de ese trabajador ya existe, intente con otro id');</script>";
        echo "<script>history.go(-1);</script>";
    }else{
        $sql=$conexion->query("INSERT INTO trabajadores (id, nombre, telefono, correo, fecha_registro, puesto) VALUES ('$idtrabajador', '$nombretrabajador', '$telefonotrabajador', '$correotrabajador', '$fechatrabajador', '$puestotrabajador')");
    }
    
}
function borrar($id,$conexion){
    $sql=$conexion->query("DELETE FROM herramientas WHERE id = '$id'");
    echo "<script>alert('Se ha eliminado el registro $id');</script>";
    echo'<script type="text/javascript">window.location.href="almacen.php";</script>';
}
function borrar1($id,$conexion){
    $sql=$conexion->query("DELETE FROM trabajadores WHERE id = '$id'");
    echo "<script>alert('Se ha eliminado el registro');</script>";
    echo'<script type="text/javascript">window.location.href="almacen.php";</script>';
}
if(!empty($_POST["actualizar"])){
    $idherramienta = $_POST["id_tool"];
    $nombreherramienta = $_POST["name_tool"];
    $colorherramienta = $_POST["color_tool"];
    $tipodeherramienta = $_POST["type_tool"];
    $fechadeherramienta = $_POST["date_tool"];
    $descripcionherramienta = $_POST["description_tool"];
    $sql=$conexion->query("UPDATE herramientas SET nombre = '$nombreherramienta' , color = '$colorherramienta' , tipo = '$tipodeherramienta', fecha = '$fechadeherramienta', descripcion='$descripcionherramienta' WHERE id = '$idherramienta'");
}
if(!empty($_POST["actualizar2"])){
    $idtrabajador = $_POST["id_worker"];
    $nombretrabajador = $_POST["name_worker"];
    $telefonotrabajador = $_POST["phone_worker"];
    $correotrabajador = $_POST["email_worker"];
    $fechatrabajador = $_POST["date_worker"];
    $puestotrabajador = $_POST["work_worker"];
    $sql=$conexion->query("UPDATE trabajadores SET nombre = '$nombretrabajador' , telefono = '$telefonotrabajador' , correo = '$correotrabajador', fecha_registro = '$fechatrabajador', puesto ='$puestotrabajador' WHERE id = '$idtrabajador'");
}

if(!empty($_POST["button_prestamo"])){
    $idtrabajador = $_POST["data-text0"];
    $idherramienta = $_POST["data-text1"];
    $fecha = date("Y-m-d");
    $fechafinal = $_POST["prestamo-date"];
    $cantidad = $_POST["cantidad-tool1"];
    $contador = $_POST["contador"];
    for ($i = 1; $i <= $contador; $i++) {
        $idherramienta = $_POST["data-text$i"];
        $sql=$conexion->query("INSERT INTO prestamo (idtrabajador, idherramienta, fechaprestamo, fechafinalizacion, cantidad) VALUES ('$idtrabajador','$idherramienta','$fecha','$fechafinal','$cantidad')");
    }
    #echo "<script>alert('$contador');</script>";
    #$sql=$conexion->query("INSERT INTO prestamo (idtrabajador, idherramienta, fechaprestamo, fechafinalizacion, cantidad) VALUES ('$idtrabajador','$idherramienta','$fecha','$fechafinal','$cantidad')");
}
if(!empty($_POST["prestamo_delete"])){
    $idprestamo = $_POST["id"];
    echo "<script>alert('ID a eliminar $idprestamo');</script>";
    $sql=$conexion->query("DELETE FROM prestamo WHERE idprestamo = '$idprestamo'");
}
?>