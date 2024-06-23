<?php
require('./conexion.php');
include 'header.php';
?>
<main>
<h2 class="m-4">Alta de usuario</h2>
    <div class="container w-50 bg-light vh-100">
    <form class="mx-2" method="post" action="insertar.php">
        <label class="row form-label" for="nombre">Nombre:</label>
        <input class="row form-control" type="text" name="nombre" id="nombre" required>
        
        <label class="row form-label" for="nombreUsuario">Nombre de Usuario:</label>
        <input class="row form-control" type="password" name="nombreUsuario" id="nombreUsuario" required>
       
        <label class="row form-label" for="contrasenia">Contraseña:</label>
        <input class="row form-control" type="password" name="contrasenia" id="contrasenia" required>
    
        <div class='d-flex w-50 m-2 d-sm-block gap-2'>
            <input class="btn btn-outline-primary" type="submit" value="Insertar">
            <input type="button" class="btn btn-outline-success mx-6" onclick="window.location.href='home.php'" value="Volver">
        </div>
    </form>
    </div>
    </main>

<?php
include 'footer.php';


// Crear la tabla si no existe

$sql = "CREATE TABLE IF NOT EXISTS admins1m (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    nombreUsuario VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === false) {
    echo "Error al crear la tabla: " . $conn->error;
}

// Obtener los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasenia = $_POST['contrasenia'];

// Sentencia SQL para insertar los datos
$sql = "INSERT INTO users3 (nombre, nombreUsuario, contrasenia) VALUES ('$nombre', '$nombreUsuario', '$contrasenia')";

if ($conn->query($sql) === TRUE) {
   header('listadoadmins.php');

} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
}
?>