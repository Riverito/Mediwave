<?php
require_once 'dbh.inc.php';
/*############################################REGISTER FUNCTIONS################################################*/
function emptyInputSignup($user_name, $pwd, $pwdRepeat, $user_apellido, $userCd, $userEmail, $userRol)
{
    $result;
    if (empty($user_name) || empty($pwd) || empty($pwdRepeat) || empty($user_apellido) || empty($userCd) || empty($userEmail) || empty($userRol)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function editEmptyInputSignup($user_name, $user_apellido, $userCd, $userEmail, $userRol)
{
    $result;
    if (empty($user_name)  || empty($user_apellido) || empty($userCd) || empty($userEmail) || empty($userRol)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidName($user_name)
{
    $result;
    if (!preg_match("/^[a-zA-Z]*$/", $user_name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidSecondName($user_apellido)
{
    $result;
    if (!preg_match("/^[a-zA-Z]*$/", $user_apellido)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidCd($userCd)
{
    $result;
    if (!preg_match("/^\d{7,8}$/", $userCd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function valid_email($userEmail) 
{
    if(is_array($userEmail) || is_numeric($userEmail) || is_bool($userEmail) || is_float($userEmail) || is_file($userEmail) || is_dir($userEmail) || is_int($userEmail))
        return false;
    else
    {
        $userEmail=trim(strtolower($userEmail));
        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)!==false) return $userEmail;
        else
        {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            return (preg_match($pattern, $userEmail) === 1) ? $userEmail : false;
        }
    }
}
function pwdMatch($pwd, $pwdRepeat)
{
    $result;
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
    $sql = "SELECT * FROM users WHERE user_id = ?;";
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
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: " . url() . "/register.php?error=stmtfailed");
        exit();
    }

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

/*############################################LOGIN FUNCTIONS################################################*/

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
            header("location: " . url() . "/inventorydashboard.php"); // Redirige a la página de inicio del enfermero

            break;
        case 2:
            header("location: " . url() . "/medidashboard.php"); // Redirige a la página de inicio del doctor
            break;
        case 1:
            header("location: " . url() . "/admindashboard.php"); // Redirige a la página de inicio del administrador
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
            $userId = $r["user_id"];
            $userRol = $r["userRol"];
        }

        if (password_verify($pwd, $hashedPwd)) {
            createSession($userId, $userRol);
        } else {
            header("location: " . url() . "/login.php?error=clavemal");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("location: " . url() . "/login.php?error=usuarionoexiste");
    }
}

function LogoutUser()
{
    // Destruye la sesión
    session_destroy();
    // Redirige al usuario de vuelta al login
    header("location: " . url() . "/login.php");
    exit();
}

################################### CRUD FUNCTIONS#############################################

function createUser($conn, $user_name, $pwd, $user_apellido, $userCd, $userEmail, $userRol)
{
    $user_id = generateUserid();

    $sql = "INSERT INTO users  (user_id, usersName, usersPwd, userApellido, userCd, userEmail, userRol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $user_id, $user_name, $hashedPwd, $user_apellido, $userCd, $userEmail, $userRol);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($conn) == 1062) {
        return '1062';
    }

    mysqli_stmt_close($stmt);
    return "registrado";
}

function editUser($user_name, $user_apellido, $userCd, $userEmail, $userRol, $userId)
{
    $conn = $GLOBALS['conn'];
    $sql = "UPDATE users SET usersName=?, userApellido=?, userCd=?, userEmail=?, userRol=? WHERE user_id=?";
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
    $sql = "SELECT * FROM users WHERE user_id = ?;";
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

        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, $sql);
        // Manejar error de preparación de la sentencia



        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: " . url() . "/admindashboard.php"); // Redirige a la página de inicio del usuario
        exit();
    } else {
        echo 'no hay vainas';
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
