<?php 
  require "codigologin.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Colegio San Luis</title>
        <link rel="stylesheet" href="css/estilos.css">

        <meta name="viewport" content="width-device-width, user-scalable-no,
            initial-scale-1.0, maxium-scale-1.0, minium-scale-1.0">
    </head>
    <body>
        <div class="container-all">
            <div class="ctn-form">
                <img src="images/LogoSanLuis.jpg" alt="" class="logo">
                <h1 class="title">Iniciar Sesión</h1>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="">Correo</label>
                    <input type="text" name="email">
                    <span class="msg-error"><?php echo $email_err; ?></span>
                    <label for="">Contraseña</label>
                    <input type="password" name="password">
                    <span class="msg-error"><?php echo $password_err; ?></span>

                    <input type="submit" name="entrar" value="entrar">
  		            <button>Entrar</button>

                </form>
                <span class="text-footer">¿Aún no te has regisrado?
                    <a href="registro.php">Registrate</a>
                </span>

            </div>
            <div class="ctn-text">
                <div class="capa"></div>
                <h1 class="title-description">Bienvenido al Colegio San Luis</h1>
                <p class="text-description">Colegio San Luis Fundado en 1990</p>
            </div>
        </div>
    </body>
</html>