<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // check if user can access task (a helper function, if u will)
    public function canAccess($employee_id, $task_id)
    {
        $query = "SELECT assigned_to FROM task WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $task_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $task = mysqli_fetch_assoc($result);

        return $task && $task['assigned_to'] == $employee_id;
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM task_view";
        $result = mysqli_query($this->conn, $query);
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getTaskById($id)
    {
        $query = "SELECT * FROM task_view WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $task = mysqli_fetch_assoc($result);
        return $task;
    }

    public function addTask($data, $employee_id)
    {
        $task_title = $data['task_title'];
        $task_desc = $data['task_description'];
        $assigned_to = $employee_id;
        $task_dept = $data['task_dept'];
        $task_due = $data['task_due'];
        $task_status = $data['task_status'] ?? 1;
        $task_priority = $data['task_priority'] ?? 2;

        $query = "INSERT INTO task (title, description, assigned_to, department_id, due_date, status_id, priority_id, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssiisii", $task_title, $task_desc, $assigned_to, $task_dept, $task_due, $task_status, $task_priority);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }

    public function updateTask($id, $data, $employee_id)
    {
        if (!$this->canAccess($employee_id, $id)) {
            return ['error' => 'Access denied'];
        }

        $task_title = $data['task_title'];
        $task_desc = $data['task_description'];
        $task_dept = $data['task_dept'] ?? null;
        $task_due = $data['task_due'];
        $task_status = $data['task_status'];
        $task_priority = $data['task_priority'];

        $query = "UPDATE task SET 
    title = ?,
    description = ?,
    assigned_to = ?,
    department_id = ?,
    due_date = ?,
    status_id = ?,
    priority_id = ?,
    updated_at = NOW()
    WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssiisiii", $task_title, $task_desc, $employee_id, $task_dept, $task_due, $task_status, $task_priority, $id);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }
    public function deleteTask($id, $employee_id)
    {
        if (!$this->canAccess($employee_id, $id)) {
            return ['error' => 'Access denied'];
        }

        $query = "DELETE FROM task WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }
}