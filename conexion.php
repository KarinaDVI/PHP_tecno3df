<?php
// Configuración de la conexión a la base de datos
//tecsanio
/* $servername = 'localhost';
$username = 'c1621279_isft225';
$password = '37faPAgugi';
$dbname = 'c1621279_isft225'; */

//infinityfree
/* $servername = 'sql104.infinityfree.com';
$username = 'if0_36491481';
$password = '0WGryin9WOMt';
$dbname = 'if0_36491481_clinica_animales';
 */
//00webhost
/* $servername = 'localhost';
$username = 'id22335837_karinabb';
$password = 'fsfs8JKL2hGGGHd99a))';
$dbname = 'id22335837_clinicaanimales'; */
//localhost(mio)
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