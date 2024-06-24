<?php
// Configuración de la conexión a la base de datos

//localhost - cambiar
$servername = 'localhost';
$username = 'admin';
$password = 'pass';
$dbname = 'clinica_animales';

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}


/*Profe: si quiere ver todos los modulos, al 
registrarse pongase como maestro en todos los campos inluyendo contrasenia. 
*/