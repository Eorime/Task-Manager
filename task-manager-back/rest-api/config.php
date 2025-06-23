<?php
$hostname = 'localhost';
$username = "root";
$password = "momo83";
$database = "taskmanager";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("maladecn't, connection failed" . mysqli_connect_error());
}

if ($connection) {
    echo "maladec, connected";
}

function getPDO()
{
    global $hostname, $username, $password, $database;
    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("PDO Connection failed: " . $e->getMessage());
    }
}

function validateToken($token)
{
    $token = str_replace('Bearer ', '', $token);
    $token = trim($token);

    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE api_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Token validation error: " . $e->getMessage());
        return false;
    }
}

function generateToken($employee_id)
{
    $token = bin2hex(random_bytes(32));

    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE employees SET api_token = ? WHERE id = ?");
        $stmt->execute([$token, $employee_id]);
        return $token;
    } catch (PDOException $e) {
        error_log("Token generation error: " . $e->getMessage());
        return false;
    }
}

function validateCredentials($email, $password)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE email = ?");
        $stmt->execute([$email]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee && password_verify($password, $employee['password'])) {
            return $employee;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Credential validation error: " . $e->getMessage());
        return false;
    }
}

function revokeToken($employee_id)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE employees SET api_token = NULL WHERE id = ?");
        $stmt->execute([$employee_id]);
        return true;
    } catch (PDOException $e) {
        error_log("Token revocation error: " . $e->getMessage());
        return false;
    }
}
