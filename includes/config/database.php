<?php
function conectarBD() :mysqli
{
  $db = mysqli_connect("localhost", "root", "francobertoni12", "bienesraices_crud");
  //host, usuario, contraseña ,bd

  if (!$db) {
    echo "Error";
    exit; //detener app
  }
  return $db;
}