<?php
//Importar la conexion
require 'includes/config/database.php';
$db = conectarBD();

//Crear un email y un password
$correo = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password,PASSWORD_DEFAULT);

//Query para crear un usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('{$correo}' , '{$passwordHash}');";

//Agregamos a la BD
mysqli_query($db,$query);


?>