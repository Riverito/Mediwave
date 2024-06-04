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

/* ########################################## ## SESSION FUNCTIONS  ########################################## ######*/
function checkSession(){
    if( session_status() === PHP_SESSION_NONE || !isset($_SESSION) || empty($_SESSION)){
        return false;
    }

    if( checkSessionID() && checkSessionRole() ){
        return true;
    }
    return false;
}

function checkSessionID(){
    if(session_status() === PHP_SESSION_NONE || !isset($_SESSION)){
        return false;
    }
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE idUsuario = ?";
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

function checkSessionRole(){
    if(session_status() === PHP_SESSION_NONE || !isset($_SESSION)){
        return false;
    }
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE userRol = ? AND idUsuario = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userRol'], $_SESSION['idUsuario']);
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
    $sql = "SELECT * FROM users WHERE idUsuario = ?;";
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

function emailExists($filteredEmail)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM users WHERE userEmail = ?;";
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
            $_SESSION["idUsuario"] = $userId;
            $_SESSION["userRol"] = $userRol;
        } else {
            header("location: /auth?error=002");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("location: /auth?error=001");
    }
}

################################### USERS FUNCTIONS ########################################## ###

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

    mysqli_stmt_close($stmt);
    return true;
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

///AAAAAAAAAAAAA
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


########################################## #################### #########################################
########################################## FUNCIONES INVENTARIO #########################################
########################################## #################### #########################################


function emptyNewItem($itemName, $ItemDrescription)
{

    if (empty($itemName)  || empty($ItemDrescription)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidItem($itemName)
{

    if (preg_match("/^[a-zA-Z\d\s\-]*$/", $itemName)) {
        return false;
    }
    return true;
}

function itemExists($itemName)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM inventory WHERE nameItem = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $itemName);
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


function createItem($itemName, $ItemDrescription)
{
    $id = generateUserid();

    $sql = "INSERT INTO inventory  (idItem, nameItem, descriptionItem) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $id, $itemName, $ItemDrescription);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($GLOBALS['conn']) == 1062) {
        return '1062';
    }

    mysqli_stmt_close($stmt);
    return true;
}


function updateInventory($itemId, $itemQuantity, $operation)
{
    $conn = $GLOBALS['conn'];
    $currentCount = 0;


    $sql = "SELECT countItem FROM inventory WHERE idItem = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    mysqli_stmt_bind_param($stmt, "s", $itemId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $currentCount = $row['countItem'];
    }
    mysqli_stmt_close($stmt);

    if ($operation === "sum") {
        $newCount = $currentCount + $itemQuantity;
    } elseif ($operation === "subtract") {
        $newCount = $currentCount - $itemQuantity;
        if ($newCount < 0) {
            return 0;
        }
    } else {
        die("Operación no válida: " . htmlspecialchars($operation));
    }

    $sql = "UPDATE inventory SET countItem = ? WHERE idItem = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("is", $newCount, $itemId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}




function logAdjustment($itemId, $quantity, $operation, $reason)
{
    $adjustmentId = generateUserid();  // Suponiendo que tienes una función para generar ID de ajustes
    $userId = "cwCmzz";  // Suponiendo que tienes una función para generar ID de usuario

    $conn = $GLOBALS['conn'];
    $adjustmentAmount = ($operation === 'subtract') ? -$quantity : $quantity;

    $sql = "INSERT INTO inventory_adjustments (adjustmentId, itemId, adjustmentAmount, adjustmentReason, adjustmentDateTime, userId) VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssiss", $adjustmentId, $itemId, $adjustmentAmount, $reason, $userId);
    $result = $stmt->execute();

    if (!$result) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();

    return $result;
}

function deleteItem($userId)
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

########################################## #################### #########################################
##########################################  FUNCIONES MEDICAS   #########################################
########################################## #################### #########################################


function emptyNewpatient($patientName, $PatientSecondName,$PatientGenre,$PatienAge)
{
    if (empty($patientName)  || empty($PatientSecondName) || empty($PatientGenre) || empty($PatienAge) ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createPatient($patientName, $patientLastName, $patientGenre, $patientAge, $patientCd) {
    $id = generateUserid();
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO patients (idPatient , patientName, patientLastName, patientCd, patientDOB, patientGender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($GLOBALS['conn']);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Si hay un error al preparar la consulta, retornar el mensaje de error
        return "Error al preparar la consulta: " . mysqli_error($GLOBALS['conn']);
    }

    // Vincular los parámetros a la consulta preparada
    $success = mysqli_stmt_bind_param($stmt, "ssssss", $id, $patientName, $patientLastName, $patientCd, $patientAge, $patientGenre);
    if (!$success) {
        // Si hay un error al vincular los parámetros, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al vincular los parámetros: " . mysqli_stmt_error($stmt);
    }

    // Ejecutar la consulta preparada
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        // Si hay un error al ejecutar la consulta, retornar el mensaje de error
        mysqli_stmt_close($stmt);
        return "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);

    // Retornar null si no hay errores
    return true;
}

function patientCdExists($userCd)
{
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM patients WHERE patientCd = ?;";
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