<?php
require_once "config.php";
require_once "task.php";
require_once "employee.php";
//instance the classes
$taskObject = new Task($connection);
$employeeObject = new Employee($connection);
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
        if ($endpoint === "/employees") {
            $employees = $employeeObject->getAllEmployees();
            echo json_encode(['employees' => $employees, 'message' => 'hewwooo']);
        }
        break;
    case "POST":
        if ($endpoint === "/tasks") {
            //add a new task
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(["success" => $result]);
        }
        if ($endpoint === "/employees") {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['success' => $result]);
        }
        break;
    case "PUT":
        if (preg_match("/^\/tasks\/(\d+)$/", $endpoint, $matches)) {
            //update employee by id
            $taskId = $matches[1];
            $data = json_decode(file_get_contents("php://inputs"), true);
            $result = $taskObject->updateTask($taskId, $data);
            echo json_encode(['success' => $result]);
        }
        break;
    case "DELETE":
        if (preg_match("/^\/tasks\/(\d+)$/", $endpoint, $matches)) {
            //delete employee by id 
            $taskId = $matches[1];
            $result = $taskObject->deleteTask($taskId);
            echo json_encode(['success' => $result]);
        }
        if (preg_match("/^\/employees\/(\d+)$/", $endpoint, $matches)) {
            $employeeId = $matches[1];
            $result = $employeeObject->deleteEmployee(($employeeId));
            echo json_encode(['success' => $result]);
        }
        break;
}
