<?php
$msge = "";
if (isset($_POST['Login'])) {
    include 'conexion.php';

    // comprobar password
    $user = $_POST['username'];
    $pass = $_POST['userpass'];

    $resultado = mysqli_query($conn, "SELECT * FROM admins1m WHERE nombreadmin = '$user'");

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $pass_hash = $row['contrasenia'];

        // Verifica si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($pass, $pass_hash)) {
            session_name('back');
            session_start();
            $_SESSION['Usuario'] = $row['nombreadmin'];
            $_SESSION['IDUsuario'] = $row['ida'];
            $_SESSION['Nombre'] = $row['nombre'];
            $_SESSION['Perfil'] = $row['perfil'];
            $_SESSION['is_logged'] = 1;

        header('location: home.php');
        exit();
    } else {
        $msge = "<p class='text text-danger'>Usuario o password incorrecto, reingrese los datos<p>";
        echo "<meta http-equiv='refresh' content='3;url=login.php'>";
    }

    $conn->close();
  }
}
?>

<!-- Section: Design Block -->
<!DOCTYPE html>
<html lang="es"> <!-- Este es una página en español -->
<head>
	<meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
<div class="container d-flex align-items-center justify-content-center vh-100 w-50">
  
  <div class="card mb-3">
    <div class="row g-0">
    <h2 class="pt-2 pl-2 col-s-4 pt-2 text-sm-center">Login</h2>
      <div class="col-lg-4 d-none d-lg-flex col align-items-center justify-content-center">
     
      <div class="row g-0 ms-4">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
          class="w-100 h-auto rounded ml-5" />
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form method="post" action="login.php">
            <!-- Email input -->
            <div class="form-outline form-floating mb-4">
              <input type="text" id="form2Example1" class="form-control" name="username"/>
              <label class="form-label" for="form2Example1">Nombre de usuario</label>
            </div>

            <!-- Password input -->
            <div class="form-outline form-floating mb-4">
              <input type="password" id="form2Example2" class="form-control" name="userpass"/>
              <label class="form-label" for="form2Example2">Contraseña</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
            <div class="col d-flex justify-content-center">
              <a href="register.php">No se registró? Registrate!</a>
            </div>
            </div>

            <!-- Submit button -->
            <div class="col d-flex justify-content-center gap-2">
              <button type="submit" class="btn btn-primary btn-block mb-4" name="Login">Login</button>
              <a href="index.php" ><input class="btn btn-outline-success mb-4" type="button" value="Volver"></input></a>
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

