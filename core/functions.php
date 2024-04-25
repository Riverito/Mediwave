<?php
require_once 'DB.php';
/* ########################################## ## LAYOUT FUNCTIONS  ########################################## ######*/
function get_header()
{
    include('./layouts/header.php'); // Ruta al archivo header.php
}

function get_footer()
{
    include('./layouts/footer.php'); // Ruta al archivo footer.php
}
/* ########################################## ## LAYOUT FUNCTIONS  ########################################## ######*/

/* ########################################## ## REGISTER FUNCTIONS  ########################################## ######*/
function emptyInputSignup($user_name, $pwd, $pwdRepeat, $user_apellido, $userCd, $userEmail, $userRol)
{
    if (empty($user_name) || empty($pwd) || empty($pwdRepeat) || empty($user_apellido) || empty($userCd) || empty($userEmail) || empty($userRol)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function editEmptyInputSignup($user_name, $user_apellido, $userCd, $userEmail, $userRol)
{
    if (empty($user_name)  || empty($user_apellido) || empty($userCd) || empty($userEmail) || empty($userRol)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidName($user_name)
{
    if (preg_match("/^[a-zA-Z]*$/", $user_name)) {
        return false;
    }
    return true;
}

function invalidSecondName($user_apellido)
{
    if (!preg_match("/^[a-zA-Z]*$/", $user_apellido)) {
        return true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidCd($userCd)
{
    if (!preg_match("/^\d{7,8}$/", $userCd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function valid_email($userEmail)
{
    if (is_array($userEmail) || is_numeric($userEmail) || is_bool($userEmail) || is_float($userEmail) || is_file($userEmail) || is_dir($userEmail) || is_int($userEmail)) {
        return false;
    }

    $pattern = '/\b[\w.-]+@[\w.-]+.\w{2,4}\b/i';
    if (preg_match($pattern, $userEmail) != 1) {
        return false;
    }

    $userEmail = trim(strtolower($userEmail));
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL) == false) {
        return false;
    }

    return $userEmail;
}

function pwdMatch($pwd, $pwdRepeat)
{
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($userId)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: " . url() . "/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount >= 1) {
        return true;
    } else {
        return false;
    }
}

function cdExists($userCd)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE userCd = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userCd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount >= 1) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emailExists($userCd)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userCd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount >= 1) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function generateUserid($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $id = '';
    for ($i = 0; $i < $length; $i++) {
        $id .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $id;
}

/* ########################################## ##LOGIN FUNCTIONS ########################################## ######*/

function emptyInputLogin($userEmail, $pwd)
{

    if (empty($userEmail) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createSession($userId, $userRol)
{
    session_start();

    $_SESSION["userId"] = $userId;
    $_SESSION["userRol"] = $userRol;

    switch ($userRol) {
        case 3:
            header("location: " . url() . "/dashboard.php"); // Redirige a la página de inicio del enfermero
            break;
        case 2:
            //TODO: IT DOES NOT HAVE LAYOUT YET SO THIS TECHNICALLY DOESNT WORK BRO WTF.
            header("location: " . LAYOUTS_DIR . "/dashboard/users.php"); // Redirige a la página de inicio del doctor
            break;
        case 1:
            header("location: " . LAYOUTS_DIR . "/dashboard/users.php"); // Redirige a la página de inicio del administrador
            break;
    }
    exit();
}

function LoginUser($conn, $userEmail, $pwd)
{

    $conn = $GLOBALS['conn'];

    $sql = "SELECT * FROM users WHERE userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_all($resultData, MYSQLI_ASSOC)) {

        foreach ($row as $r) {
            $hashedPwd = $r["usersPwd"];
            $userId = $r["idUsuario"];
            $userRol = $r["userRol"];
        }

        if (password_verify($pwd, $hashedPwd)) {

            session_start();

            $_SESSION["idUsuario"] = $userId;
            $_SESSION["userRol"] = $userRol;
        } else {
            header("location: /auth?error=002"); //002 Clave erronea
        }
        mysqli_stmt_close($stmt);
    } else {
        header("location: /auth?error=001"); //001 Usuario no existe
    }
}

function LogoutUser()
{
    // Destruye la sesión
    session_destroy();
    // Redirige al usuario de vuelta al login
    header("location: /");
    exit();
}

################################### CRUD FUNCTIONS ########################################## ###

function createUser($user_name, $pwd, $user_apellido, $userCd, $userEmail, $userRol)
{
    $id = generateUserid();

    $sql = "INSERT INTO users  (idUsuario, usersName, usersPwd, userApellido, userCd, userEmail, userRol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $id, $user_name, $hashedPwd, $user_apellido, $userCd, $userEmail, $userRol);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($GLOBALS['conn']) == 1062) {
        return '1062';
    }

    mysqli_stmt_close($stmt);
    return true;
}

function editUser($user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId)
{
    $conn = $GLOBALS['conn'];
    $sql = "UPDATE users SET usersName=?, userApellido=?, userCd=?, userEmail=?, userRol=? WHERE idUsuario=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($conn) == 1062) {
        return '1062';
    }
    mysqli_stmt_close($stmt);
    return 'success';
}

function userView($userId)
{

    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        $userData = [
            'username' => $row['usersName'],
            'apellido' => $row['userApellido'],
            'email' => $row['userEmail'],
            'cd' => $row['userCd'],
            'rol' => $row['userRol'],
        ];
        return $userData;
    }
}

function deleteUser($userId)
{
    if (uidExists($userId)) {


        $conn = $GLOBALS['conn'];

        $sql = "DELETE FROM users WHERE idUsuario = ?";
        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, $sql);
        // Manejar error de preparación de la sentencia

        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        exit();
    } else {
        echo 'Esta entrada ya no existe';
    }
}

$GLOBALS['medi'] = '/mediwave';
function url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $GLOBALS['medi']
    );
}



 ##########################################  ########################################## ####################
 ########################################## FUNCIONES INVENTARIO ########################################## 
 ##########################################  ########################################## ####################
