<?php
require('./conexion.php');
// Crear la tabla si no existe
/* $sql = "CREATE TABLE IF NOT EXISTS admins1m (
    ida INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    nombreadmin VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(50) NOT NULL,
    estado INT(1) UNSIGNED NOT NULL,
    perfil INT(1) UNSIGNED NOT NULL
)";  */

/* if ($conn->query($sql) === false) {
    echo "Error al crear la tabla: " . $conn->error;
}
 */
$msge="";
//comprobar password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nombreAdmin = $_POST['nombreadmin'];
    $contrasenia = $_POST['userpass'];
    $contrasenia2 = $_POST['userpass2'];


    if( $contrasenia2==$contrasenia){
        $contrasenia =password_hash($contrasenia, PASSWORD_DEFAULT);
        $verifica_existencia = mysqli_query($conn, "SELECT * FROM admins1m 
                                                    WHERE nombreadmin='$nombreAdmin'");
        
        if (mysqli_num_rows($verifica_existencia) > 0) {
          $msge = "<p style='color: #CA2E2E;'>Usuario existente, intente con otro.<p>";
          } 
          else {
            $sql = "INSERT INTO admins1m (nombre, nombreadmin, contrasenia, perfil) 
                    VALUES ('$nombre','$nombreAdmin','$contrasenia', 'usuario')";
        
            if ($conn->query($sql) === TRUE) {
              $msge = "<p style='color: #2ECA6A;'>Registro exitoso.<p>";
              echo "<meta http-equiv='refresh' content='2;url=login.php'>";
              } 
              else {
                  $msge = "<p style='color: #CA2E2E;'>Error al insertar el registro: " . $conn->error . "<p>";
                  }
                }
      } else {
        $msge = "<p style='color: #CA2E2E;'>Las contraseñas deben coincidir.<p>";
      }
  /* Busqueda de usuario */
    /* $sql = "SELECT ida, nombre, nombreUsuario, contrasenia,FROM admins1m WHERE nombreUsuario='$user' AND contrasenia='$pass'"; */
$conn->close();
}
?>
<!-- Section: Design Block -->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
<div class="container d-flex align-items-center justify-content-center vh-100 w-50">
  
  <div class="card mb-3">
    <div class="row g-0">
    <h2 class="pt-2 pl-2 col-s-4 pt-2 text-sm-center">Registro</h2>
      <div class="col-lg-4 d-none d-lg-flex col align-items-center justify-content-center">
     
      <div class="row g-0 ms-4">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
          class="w-100 h-auto rounded ml-5" />
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form method="post" action="register.php">
            <!-- Usuario input -->
            <div class="form-outline form-floating mb-3">
              <input type="text" id="nombre" class="form-control"  name="nombre"/>
              <label class="form-label" for="nombre">Nombre </label>
            </div>

            <div class="form-outline form-floating mb-3">
            <input type="text" id="nombreadmin" class="form-control" name="nombreadmin"/>
              <label class="form-label" for="nombreadmin">Nombre de usuario</label>
              <?=$msge?>
            </div>

            <!-- Password input -->
            <div class="form-outline form-floating mb-3">
              <input type="password" id="userpass" class="form-control" name="userpass"/>
              <label class="form-label" for="userpass">Contraseña</label>
            </div>

             <!-- Password input -->
             <div class="form-floating mb-3">
              <input type="password" id="contrasenia2" class="form-control" name="userpass2"/>
              <label class="form-label" for="contrasenia2">Repetir Contraseña</label>
              <label class="form-label visually-hidden" for="contrasenia2">Las contraseñas deben coincidir</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row ">
            <a href="login.php">Ya se registró? Logueate</a>
              <div class="col d-flex justify-content-center mt-4 gap-3">
                <input type="submit" class="btn btn-primary btn-block mb-4" value="Registro">
                <a href="index.php" ><input class="btn btn-outline-success mb-4" type="button" value="Volver"></input></a>
              </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

