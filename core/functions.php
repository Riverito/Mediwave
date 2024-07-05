<?php
require_once 'DB.php';
require_once 'functions/inventory.php';
require_once 'functions/medic.php';

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

/* ########################################## ## SESSION FUNCTIONS  ########################################## ######*/

function checkSession()
{
    if (checkSessionID() && checkSessionRole()) {
        return true;
    }
    return false;
}
function getAllRoles()
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM roles";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
}
function checkSessionID()
{
    if (!isset($_SESSION['idUsuario']) or !isset($_SESSION['idRol'])) {
        return false;
    }
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['idUsuario']);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount === 1) {
        return true;
    } else {
        return false;
    }
}

function routeAccessController()
{
    if (checkSession()) {
        return $_SESSION['idRol'];
    }
}

function updateSessionRole()
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['idUsuario']);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);

    if (!empty($rowcount) and $rowcount === 1) {
        $row = mysqli_fetch_assoc($resultData);
        $_SESSION['idRol'] = $row['idRol'];
    }

    mysqli_stmt_close($stmt);
}


function checkSessionRole()
{
    if (!isset($_SESSION['idUsuario']) or !isset($_SESSION['idRol'])) {
        return false;
    }

    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE idRol = ? AND idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $_SESSION['idRol'], $_SESSION['idUsuario']);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) and $rowcount === 1) {
        return true;
    } else {
        updateSessionRole();
        return false;
    }
}

/* ########################################## ## SESSION FUNCTIONS  ########################################## ######*/

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
    if ($pwd == $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($userId)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error al preparar la consulta en uidExists: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_num_rows($resultData);
    mysqli_stmt_close($stmt);

    if (!empty($rowcount) && $rowcount >= 1) {
        return true;
    } else {
        return false;
    }
}

function cdExists($userCd)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE cedulaUsuario = ?;";
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

function emailExists($filteredEmail)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM usuarios WHERE emailUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $filteredEmail);
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

function LoginUser($userEmail, $pwd)
{
    $conn = $GLOBALS['conn'];

    $sql = "SELECT * FROM usuarios WHERE emailUsuario  = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_all($resultData, MYSQLI_ASSOC)) {
        foreach ($row as $r) {
            $hashedPwd = $r["contrasenaUsuario"];
            $userId = $r["idUsuario"];
            $userRol = $r["idRol"];
        }

        if (!password_verify($pwd, $hashedPwd)) {
            return false;
            exit;
        }
        $_SESSION["idUsuario"] = $userId;
        $_SESSION["idRol"] = $userRol;
        mysqli_stmt_close($stmt);
        return true;
    }
}


################################### USERS FUNCTIONS ########################################## ###

function createUser($user_name, $pwd, $user_apellido, $userCd, $userEmail, $userRol)
{
    $id = generateUserid();

    $sql = "INSERT INTO usuarios (idUsuario, nombreUsuario, contrasenaUsuario, apellidoUsuario, cedulaUsuario, emailUsuario, idRol) VALUES (?, ?, ?, ?, ?, ?, ?)";
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
    $sql = "UPDATE usuarios SET nombreUsuario=?, apellidoUsuario=?, cedulaUsuario=?, emailUsuario=?, idRol=? WHERE idUsuario=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return true;
}


function deleteUser($userId)
{
    if (uidExists($userId)) {
        $conn = $GLOBALS['conn'];

        $sql = "DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die('Error al preparar la consulta en deleteUser: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $userId);
        if (!mysqli_stmt_execute($stmt)) {
            die('Error al ejecutar la consulta en deleteUser: ' . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return 'Usuario eliminado correctamente';
    } else {
        return 'Usuario no encontrado';
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

function reportKill(&$response)
{
    echo json_encode($response);
    die();
}
