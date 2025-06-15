<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM task";
        $result = mysqli_query($this->conn, $query);
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getTaskById($id)
    {
        $query = "SELECT * FROM task WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $task = mysqli_fetch_assoc($result);
        return $task;
    }

    public function addTask($data)
    {
        $task_title = $data['task_title'];
        $task_desc = $data['task_description'];
        $assigned_to = $data['assigned_to'] ?? null;
        $task_dept = $data['task_dept'];
        $task_due = $data['task_due'];
        $task_status = $data['task_status'];
        $task_priority = $data['task_priority'];

        $query = "INSERT INTO task (title, description, assigned_to, department, due_date, status, priority, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssissss", $task_title, $task_desc, $assigned_to, $task_dept, $task_due, $task_status, $task_priority);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }

    public function updateTask($id, $data)
    {
        $task_title = $data['task_title'];
        $task_desc = $data['task_description'];
        $task_dept = $data['task_dept'];
        $task_due = $data['task_due'];
        $task_status = $data['task_status'];
        $task_priority = $data['task_priority'];

        $query = "UPDATE task SET 
        title = ?,
        description = ?,
        assigned_to = ?,
        department = ?,
        due_date = ?,
        status = ?,
        priority = ?,
        updated_at = NOW()
        WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ssissssi", $task_title, $task_desc, $assigned_to, $task_dept, $task_due, $task_status, $task_priority, $id);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM task WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        return $result ? true : false;
    }
}