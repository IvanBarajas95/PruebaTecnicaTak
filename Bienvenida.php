<?php 

   session_start();

   if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== true){
       header("location: index.php");
       exit;
   }
   ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Bienvenido al Colegio San Luis</title>
            <link rel="stylesheet" href="css/estilos.css">

            <meta name="viewport" content="width-device-width, user-scalable-no,
                initial-scale-1.0, maxium-scale-1.0, minium-scale-1.0">
        </head>
        <body>
            <div class="ctn-welcome">
                <img src="images/LogoSanLuis.jpg" alt="" class="logo-welcome">
                <h1 class="title-welcome">Bienvenido al <b>Colegio San Luis</b></h1>
                <header>
                    <nav class="navegacion">
                        <ul class="menu">
                            <li><a href="#">Alumnos</a>
                                <ul class="submenu">
                                    <li><a href="crearalumnos.php">Crear Alumnos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </header>
                <a href="cerrarsesion.php" class="close-sesion">Cerrar Sesión</a>
            </div>
        </body>
    </html>