<?php
class Status
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllStatuses()
    {
        $query = "SELECT * FROM status";
        $result = mysqli_query($this->conn, $query);
        $statuses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $statuses[] = $row;
        }
        return $statuses;
    }

    public function getStatusById($id)
    {
        $query = "SELECT * FROM status WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "id",  $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $status = mysqli_fetch_assoc($result);
        return $status;
    }
}

