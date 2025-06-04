<?php
require_once "config.php";
require_once "task.php";
require_once "employee.php";
//instance of the task class
$taskObject = new Task($connection);
//get request method
$method = $_SERVER["REQUEST_METHOD"];
//get the requested endpoint
$endpoint = $_SERVER["PATH_INFO"];
//set content type of the request
header("Content-type: application/json");
//process the request
switch ($method) {
    case "GET":
        if ($endpoint === "/tasks") {
            //get all tasks
            $tasks = $taskObject->getAllTasks();
            echo json_encode(['tasks' => $tasks, 'message' => 'salam salam']);
        }
        break;
    case "POST":
        if ($endpoint === "/tasks") {
            //add a new task
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(["success" => $result]);
        }
        break;
    case "PUT":
        if (preg_match("/^\/employees\/(\d+)$/", $endpoint, $matches)) {
            //update employee by id
            $taskId = $matches[1];
            $data = json_decode(file_get_contents("php://inputs"), true);
            $result = $taskObject->updateTask($taskId, $data);
            echo json_encode(['success' => $result]);
        }
        break;
    case "DELETE":
        if (preg_match("/^\/employees\/(\d+)$/", $endpoint, $matches)) {
            //delete employee by id 
            $taskId = $matches[1];
            $result = $taskObject->deleteTask($taskId);
            echo json_encode(['success' => $result]);
        }
        break;
}
