<?php
/* Esto es de login: */
if (session_status() === PHP_SESSION_NONE) {
  session_name('back');
  session_start();
  
}
if ($_SESSION['is_logged'] == 0) {
  header('location: login.php?mensaje=Se ha desconectado del sistema');
  exit();
}

?>
<!DOCTYPE html>
<html lang="es"> <!-- Este es una página en español -->
<head>
	<meta charset="UTF-8"><!-- Estos son caracteres especiales-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- MIO: -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <!-- Material deesign icons -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <link rel="stylesheet" href="./src/styles.css" />
      <!--  -->
    <!--  -->
  </head>
<body>
  <header style='margin-bottom:125px'>
  <a id="heading" class="visually-hidden"></a>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle fixed-top mb-5 barra-navegacion">
      <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <svg width="75" height="75" viewBox="0 0 500 500">
            <path xmlns="http://www.w3.org/2000/svg" id="Selección #1" d="M 169.404 12.027 C 184.908 9.17 199.28 15.929 210.1 26.709 C 224.744 41.305 234.009 63.369 234.041 84.164 C 234.041 84.164 234.041 91.346 234.041 91.346 C 234.009 113.73 221.256 142.45 197.333 147.589 C 175.229 152.345 156.468 138.587 144.937 120.872 C 126.16 92.001 123.647 38.528 155.838 17.692 C 160.809 14.468 163.865 13.654 169.404 12.027 Z M 316.233 11.956 C 342.447 7.845 359.707 27.189 366.171 50.65 C 373.089 75.802 366.969 105.79 351.152 126.458 C 343.819 136.05 332.401 145.33 320.222 147.629 C 290.849 153.183 272.519 130.632 267.396 104.115 C 266.471 99.311 265.577 93.845 265.752 88.953 C 266.064 80.526 266.63 72.442 268.737 64.215 C 275.001 39.725 290.944 18.355 316.233 11.956 Z M 44.918 140.024 C 44.75 136.84 38.662 123.011 38.533 115.287 C 38.414 107.73 38.517 108.775 40.497 101.72 C 41.582 97.874 42.571 95.497 44.829 92.145 C 56.537 74.756 79.638 77.51 95.191 87.628 C 113.456 99.519 126.304 118.175 128.746 140.024 C 128.746 140.024 129.361 145.61 129.361 145.61 C 129.361 148.003 128.02 156.007 127.294 158.378 C 126.416 161.227 124.636 164.706 122.944 167.155 C 119.409 172.262 115.388 175.04 109.555 176.995 C 95.079 181.839 80.699 176.564 68.857 167.826 C 62.8 163.365 57.486 158.051 53.025 151.993 C 53.025 151.993 44.918 140.024 44.918 140.024 Z M 427.951 79.712 C 444.382 77.86 455.617 88.17 459.926 103.317 C 461.004 107.075 461.395 107.187 461.467 111.297 C 461.602 119.748 461.387 117.337 459.544 124.862 C 455.059 143.176 444.382 158.865 428.749 169.525 C 421.279 174.625 409.207 179.572 400.021 179.054 C 382.746 178.064 373.161 166.996 371.174 150.398 C 370.879 147.964 370.464 146.543 370.64 144.014 C 372.372 119.827 388.219 94.802 410.395 84.42 C 417.497 81.093 420.53 80.79 427.951 79.712 Z M 103.968 391.39 C 97.617 383.872 90.675 371.576 86.214 362.662 C 65.578 321.39 58.22 267.422 88.344 228.601 C 93.794 221.578 99.293 216.184 106.362 210.789 C 115.021 204.174 124.82 199.218 135.09 195.635 C 148.792 190.864 162.174 189.331 176.586 189.499 C 192.6 189.69 211.784 195.372 226.061 202.467 C 231.151 204.996 235.747 207.566 240.424 210.821 C 243.074 212.664 246.673 215.848 250 215.848 C 253.463 215.848 257.557 212.193 260.374 210.271 C 265.657 206.672 271.323 203.583 277.132 200.918 C 295.86 192.316 312.498 189.259 332.991 189.499 C 340.125 189.587 351.599 191.734 358.527 193.72 C 385.459 201.452 407.06 217.093 420.378 242.166 C 428.59 257.623 432.141 275.825 431.941 293.238 C 431.941 293.238 431.215 301.217 431.215 301.217 C 426.339 367.945 378.085 424.339 322.617 457.623 C 302.732 469.552 282.662 479.272 260.374 485.888 C 260.374 485.888 253.192 488.369 253.192 488.369 C 248.045 489.598 240.033 486.151 234.838 484.482 C 232.987 483.884 229.803 483.118 229.077 481.227 C 228.111 479.527 229.189 474.293 229.077 471.987 C 229.467 461.971 225.031 452.515 225.669 442.461 C 225.949 438.143 226.18 433.859 227.433 429.693 C 228.223 427.068 229.34 424.02 230.824 421.714 C 241.509 405.139 257.732 419.295 274.737 419.295 C 286.38 419.295 293.02 412.887 298.669 403.36 C 300.96 399.489 304.486 392.403 305.971 388.198 C 305.971 388.198 307.83 381.814 307.83 381.814 C 309.115 378.438 312.235 375.286 310.48 371.44 C 308.269 366.62 300.887 364.457 296.283 362.439 C 289.341 359.383 277.099 352.232 271.577 347.261 C 266.294 342.513 265.976 338.563 262.353 333.137 C 258.546 327.439 254.381 323.88 248.404 320.617 C 242.547 317.417 237.233 315.94 230.849 314.281 C 226.922 313.259 220.402 311.511 217.466 308.774 C 211.075 302.813 220.371 296.98 219.517 288.449 C 218.791 281.132 209.335 271.158 203.717 266.904 C 202.511 281.212 190.957 299.574 180.576 309.062 C 172.34 316.587 162.716 322.412 155.175 330.743 C 147.762 338.93 143.54 344.795 137.484 353.885 C 137.484 353.885 128.171 367.45 128.171 367.45 C 128.171 367.45 118.237 377.361 118.237 377.361 C 113.784 382.261 109.379 387.52 103.968 391.39 Z M 167.807 450.441 C 162.979 448.9 159.054 445.573 155.04 442.565 C 155.04 442.565 132.696 423.972 132.696 423.972 C 130.477 421.968 123.472 415.672 123.128 412.935 C 122.904 411.148 124.445 408.889 125.267 407.35 C 125.267 407.35 131.619 395.38 131.619 395.38 C 134.715 387.983 133.462 384.4 139.687 376.235 C 144.323 370.147 151.92 366.421 157.433 361.059 C 163.69 354.962 171.686 346.774 180.576 345.106 C 179.37 351.738 177.527 363.269 182.506 368.791 C 182.506 368.791 190.151 374.775 190.151 374.775 C 190.151 374.775 200.525 384.583 200.525 384.583 C 207.77 390.168 212.455 387.983 211.625 399.37 C 211.505 400.99 211.234 402.617 210.7 404.158 C 206.007 417.779 192.074 407.948 181.541 416.646 C 179.075 418.681 177.032 423.525 175.795 426.501 C 175.795 426.501 167.807 450.441 167.807 450.441 Z" 
            style="stroke: rgb(230, 10, 10); paint-order: stroke; fill: rgb(230, 10, 10);">
          </path>
        </svg>
      </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="home.php">Inicio</a>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Clientes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="listar.php">Ver Clientes Activos</a></li>
                <li><a class="dropdown-item" href="insertar.php">Altas</a></li>
              </ul>
            </li>
            <?php if ($_SESSION['Perfil'] == "administrador" || $_SESSION['Perfil'] == 'maestro'): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Administradores
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="listadoadmins.php">Listado de Administradores</a></li>
                <li><a class="dropdown-item" href="admins.php">Altas</a></li>
              </ul>
            </li>
            <?php endif;?>
            <a class="nav-link" href="listamascotas.php">Ver mascotas</a>
            <div class="d-flex align-items-center">
            <a href="logout.php" class="nav-item d-flex justify-content-end text-decoration-none"><span class="material-symbols-outlined text-primary">login</span>
              <span class="nav-item d-flex text-primary nav justify-content-end text-decoration-none"><?=$_SESSION['Nombre']." (".$_SESSION['Perfil'].")"?></span></a>
            
            </div>
             
            </div>

          </div>
        </div>
      </div>
    </nav>
  </header>