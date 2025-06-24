<?php
class Employee
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllEmployees()
    {
        $query = "SELECT id, name, lastname, email, department_id FROM employees";
        $result = mysqli_query($this->conn, $query);
        $employees = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $employees[] = $row;
        }
        return $employees;
    }

    public function getEmployeeById($id)
    {
        $query = "SELECT id, name, lastname, email, department_id FROM employees WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $employee = mysqli_fetch_assoc($result);

        return $employee;
    }

    public function addEmployee($data)
    {
        // check if required fields exist
        if (
            !isset($data['employee_name']) || !isset($data['employee_lastname']) ||
            !isset($data['employee_email']) || !isset($data['employee_dept']) ||
            !isset($data['password'])
        ) {
            return false;
        }

        $employee_name = $data['employee_name'];
        $employee_lastname = $data['employee_lastname'];
        $employee_email = $data['employee_email'];
        $employee_dept = $data['employee_dept'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT); // hash the password 

        // use prepared statement to prevent sql injection
        $query = "INSERT INTO employees (name, lastname, email, department_id, password) 
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "sssis", $employee_name, $employee_lastname, $employee_email, $employee_dept, $password);
        $result = mysqli_stmt_execute($stmt);

        return $result;
    }

    public function deleteEmployee($id)
    {
        $query = "DELETE FROM employees WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        return $result;
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM employees WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            // remove password from returned user data for security
            unset($user['password']);
            return $user;
        }
        return false;
    }
}