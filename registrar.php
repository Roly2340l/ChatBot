<?php
require_once "configuracion.php";

$username = $password = $confirm_password = "";
$error_username = $error_password = $confirm_error_password = "";

//ENVIAMOS LOS DATOS PARA LA BASE DE DATOS
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //VALIDAR NOMBRE DE USUARIO
    if (empty(trim($_POST["username"]))) {
        $error_username = "Por favor ingrese su nombre de usuario";
    } else {
        //PREPARAR LA SELECCIO DEL NOMBRE
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $error_username = "Este nombre no se encuentra disponible";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Vaya... tuvimos un problema. Vuelva a intentarlo mas tarde";
            }
        }

        mysqli_stmt_close($stmt);
    }

    //VALIDAR CONTRASEÑA
    if (empty(trim($_POST["password"]))) {
        $error_password = "Por favor ingrese su contraseña";
    } elseif (strlen(trim($_POST["password"])) < 4) {
        $error_password = "La contraseña debe tener mas de 4 caracteres";
    } else {
        $password = trim($_POST["password"]);
    }

    //VALIDAR LA CONFIRMACON DE LA CONTRASEÑA
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_error_password = "Vuelva a escribir su contraseña";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($error_password) && ($password != $confirm_password)) {
            $confirm_error_password = "Las contraseñas no son iguales";
        }
    }

    if (empty($error_username) && empty($error_password) && empty($confirm_error_password)) {

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Vaya... tuvimos un problema. Vuelva a intentarlo mas tarde";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/system.css">
    <title>Registrarse</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="system-fondo">
        <h1>Registrarse</h1>
        <p>Por favor ponga sus datos para crear una cuenta</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="grupo">
                <label>Nombre de usuario</label>
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
                <span class="grupo has-error"><br><?php echo $error_username; ?></span>
            </div>
            <div class="grupo">
                <label>Contraseña</label>
                <input type="password" name="password" class="input" value="<?php echo $password; ?>">
                <span class="grupo has-error"><br><?php echo $error_password; ?></span>
            </div>
            <div class="grupo">
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" class="input" value="<?php echo $confirm_password; ?>">
                <span class="grupo has-error"><br><?php echo $confirm_error_password; ?></span>
            </div>
            <div align="center">
                <input type="submit" class="inputb bloque" value="Registrarse">
                <input type="reset" class="inputb bloque" value="Reiniciar">
            </div>
            <p>¿Usted ya tiene una cuenta? <a href="login.php">Inicie sesión aqui</a>.</p>
        </form>
    </div>
</body>

</html>