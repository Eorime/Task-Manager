<?php
$hostname = 'localhost';
$username = "root";
$password = "momo83";
$database = "taskmanager";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("maladec, connection failed: " . mysqli_connect_error());
}

if ($connection) {
    echo "maladec, connected";
}

$connection->set_charset("utf8");

function validateToken($token)
{
    global $connection;

    $token = str_replace('Bearer ', '', $token);
    $token = trim($token);

    try {
        $stmt = mysqli_prepare($connection, "SELECT * FROM employees WHERE api_token = ?");
        if (!$stmt) {
            error_log("Token validation prepare error: " . mysqli_error($connection));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $employee = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        return $employee ? $employee : false;
    } catch (Exception $e) {
        error_log("Token validation error: " . $e->getMessage());
        return false;
    }
}

function generateToken($employee_id)
{
    global $connection;

    $token = bin2hex(random_bytes(32));

    try {
        $stmt = mysqli_prepare($connection, "UPDATE employees SET api_token = ? WHERE id = ?");
        if (!$stmt) {
            error_log("Token generation prepare error: " . mysqli_error($connection));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "si", $token, $employee_id);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $result ? $token : false;
    } catch (Exception $e) {
        error_log("Token generation error: " . $e->getMessage());
        return false;
    }
}

function validateCredentials($email, $password)
{
    global $connection;

    try {
        $stmt = mysqli_prepare($connection, "SELECT * FROM employees WHERE email = ?");
        if (!$stmt) {
            error_log("Credential validation prepare error: " . mysqli_error($connection));
            return false;
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $employee = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if ($employee && password_verify($password, $employee['password'])) {
            return $employee;
        }
        return false;
    } catch (Exception $e) {
        error_log("Credential validation error: " . $e->getMessage());
        return false;
    }
}

function revokeToken($employee_id)
{
    global $connection;

    try {
        $stmt = mysqli_prepare($connection, "UPDATE employees SET api_token = NULL WHERE id = ?");
        if (!$stmt) {
            error_log("Token revocation prepare error: " . mysqli_error($connection));
            return false;
        }

        mysqli_stmt_bind_param($stmt, "i", $employee_id);
        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return $result;
    } catch (Exception $e) {
        error_log("Token revocation error: " . $e->getMessage());
        return false;
    }
}
?>