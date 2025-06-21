<?php
class Department
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllDepartments()
    {
        $query = "SELECT * FROM departments";
        $result = mysqli_query($this->conn, $query);
        $departments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $departments[] = $row;
        }
        return $departments;
    }

    public function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $department = mysqli_fetch_assoc($result);
        return $department;
    }
}