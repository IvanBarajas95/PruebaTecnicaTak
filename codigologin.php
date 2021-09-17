<?php 

   //Inicializar la Sesion 
   session_start();

   if(isset($_SESSION["entrar"]) && $_SESSION["entrar"] === true){
       header("location:Bienvenida.php");
       exit;
   }

   require_once "conexion.php";

   $email = $password ="";
   $email_err = $password_err ="";

   if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor, ingrese el correo electronico";
    }else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, ingrese una contraseña";
    }else{
        $password = trim($_POST["password"]);
    }



    //Validar Credenciales
    if(empty($email_err) && empty($password_err)){
        $sql = "SELECT id, usuario, correo, contraseña FROM usuarios WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }

            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $usuario, $correo, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        // ALMACENAR DATOS EN VARIABLES DE SESION 
                        $_SESSION["entrar"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;

                        header("location: Bienvenida.php");
                    }else{
                        $password_err ="La contraseña que has introducido no es valida";
                    }
                }else{
                    $email_err = "No se ha encontrado ninguna cuenta con ese correo electronico.";
                }
            }else{
                echo "Ups! Algo salio mal, intentalo mas tarde";
            }
        }
    }
    
    mysqli_close($link);
    
   }



?>
