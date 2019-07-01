<?php
require_once "server/configuracion.php";

$username = $password = "";
$username_err = $error_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese su nombre de usuario";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $error_password = "Por favor ingrese su contraseña";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($error_password)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: index.php");
                        } else {
                            $error_password = "La contraseña es invalida";
                        }
                    }
                } else {
                    $username_err = "No hemos encontrado una cuenta con ese nombre";
                }
            } else {
                echo "Vaya... tuvimos un problema. Vuelva a intentarlo mas tarde";
            }
        }

        //mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/system.css">
    <meta charset="UTF-8">
</head>

<body>
    <div class="system-fondo">
        <h1>Iniciar Sesión</h1>
        <p>Por favor ingrese sus datos para ingresar al ChatBot</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="grupo">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
                <span class="grupo has-error"><?php echo $username_err; ?></span>
            </div>
            <div class="grupo">
                <label>Contraseña</label>
                <input type="password" name="password" class="input">
                <span class="grupo has-error"><?php echo $error_password; ?></span>
            </div>
            <div align="center">
                <input type="submit" class="inputc bloque" value="Iniciar Sesion">
            </div>
            <p>¿No tienes una cuenta? <a href="registrar.php">Registrate aqui</a>.</p>
        </form>
    </div>
</body>

</html>
