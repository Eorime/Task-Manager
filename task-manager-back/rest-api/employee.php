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
        $query = "SELECT * FROM employees";
        $result = mysqli_query($this->conn, $query);
        $employees = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $employees[] = $row;
        }
        return $employees;
    }
    public function getEmployeeById($id)
    {
        $query = "SELECT * FROM employees WHERE id=$id";
        $result = mysqli_query($this->conn, $query);
        $employee = mysqli_fetch_assoc($result);

        return $employee;
    }
    public function addEmployee($data)
    {
        $employee_name = $data['employee_name'];
        $employee_lastname = $data['employee_lastname'];
        $employee_email = $data['employee_email'];
        $employee_dept = $data['employ_dept'];

        $query = "INSERT INTO employees ('name', last_name, email, department) 
        VALUES ('$employee_name','$employee_lastname', '$employee_email', '$$employee_dept')";

        $result = mysqli_query($this->conn, $query);

        $result ? true : false;
    }
    public function deleteEmployee($id)
    {
        $query = "DELETE FROM employees WHERE id = $id";
        $result = mysqli_query($this->conn, $query);

        return $result ? true : false;
    }
}
