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
        $query = "SELECT * FROM task WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        $task = mysqli_fetch_assoc($result);

        return $task;
    }
    public function addTask($data)
    {
        $task_title = $data['task_title'];
        $task_desc = $data['task_desc'];
        //assigned to?
        $task_dept = $data['task_dept'];
        $task_due = $data['task_due'];
        $task_status = $data['task_status'];
        $task_priority = $data['task_priority'];
        $task_created = $data['task_created'];
        $task_updated = $data['task_updated'];
        $query = "INSERT INTO task (task_title, task_desc, task_dept, task_due, task_status, task_priority, task_created, task_updated)
        VALUES ('$task_title', '$task_desc', '$task_dept', '$task_due', '$task_status', '$task_priority', '$task_created', '$task_updated')";

        $result = mysqli_query($this->conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function updateTask($id, $data)
    {
        $task_title = $data['task_title'];
        $task_desc = $data['task_desc'];
        $task_dept = $data['task_dept'];
        $task_due = $data['task_due'];
        $task_status = $data['task_status'];
        $task_priority = $data['task_priority'];

        $query = "UPDATE task SET 
        task_title = '$task_title',
        task_desc = '$task_desc',
        task_dept = '$task_dept',
        task_due = '$task_due',
        task_status = '$task_status',
        task_priority = '$task_priority',
        task_updated = NOW()
        WHERE id = $id";

        $result = mysqli_query($this->conn, $query);

        return $result ? true : false;
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($this->conn, $query);

        return $result ? true : false;
    }
}