<?php
class Priority
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllPriorities()
    {
        $query = "SELECT * FROM priority";
        $result = mysqli_query($this->conn, $query);
        $priorities = [];
        while (
            $row = mysqli_fetch_assoc($result)
        ) {
            $priorities[] = $row;
        }
        return $priorities;
    }

    public function getPriorityById($id)
    {
        $query = "SELECT * FROM priority WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $priority = mysqli_fetch_assoc($result);
        return $priority;
    }
}