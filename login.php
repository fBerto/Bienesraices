<?php
require 'includes/config/database.php';
$db = conectarBD();

$errores =[];

//Autenticar
if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email){
        $errores[] = "El Email es obliogatorio";
    }
    if(!$password){
        $errores[] = "El Password es obliogatorio";
    }

    if(empty($errores)){
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db,$query);
        if($resultado -> num_rows){
            $usuario = mysqli_fetch_assoc($resultado);
            //Revisar Password
            $auth = password_verify($password, $usuario['password']);
            if ($auth) {
                session_start();
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true; 
                header('Location:/bienesraices/admin/index.php');
            }else{
                $errores[]='El Password es incorrecto';
            }
        }else{
            $errores[] = 'El usuario no existe';
        }
    }
}


require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach($errores as $error): ?>
    <div class="alerta error ">
        <?php  echo $error;  ?>
    </div>
    <?php endforeach;?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password" required>
        </fieldset>
    <input type="submit" value="Iniciar Sesion" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>