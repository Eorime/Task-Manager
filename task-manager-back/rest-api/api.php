<?php
require_once "config.php";
require_once "task.php";
require_once "employee.php";
require_once "priority";

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
            echo json_encode([$tasks ? ['tasks' => $tasks] : "No tasks", 'message' => 'salam salam']);
        } elseif (preg_match('/^\/tasks\/(\d+)$/', $endpoint, $matches)) {
            $taskId = $matches[1];
            $task = $taskObject->getTaskById($taskId);
            echo json_encode([$task ? ['erti taski var' => $task] : "No tasks w this id", "id" => $taskId]);
        } elseif ($endpoint === "/employees") {
            $employees = $employeeObject->getAllEmployees();
            echo json_encode([$employees ? ['employees' => $employees] : "No employees", 'message' => 'hewwooo']);
        } elseif (preg_match('/^\/employees\/(\d+)$/', $endpoint, $matches)) {
            $employeeId = $matches[1];
            $employee = $employeeObject->getEmployeeById($employeeId);
            echo json_encode([$employee ? ['employee' => $employee] : "No employee w this id"]);
        }
        break;
    case "POST":
        if ($endpoint === "/tasks") {
            //add a new task
            $data = json_decode(file_get_contents("php://input"), true);
            $result = $taskObject->addTask($data);
            echo json_encode(["success" => $result]);
        } elseif ($endpoint === "/employees") {
            $data = json_decode(file_get_contents("php://input"), true);
            $result = $employeeObject->addEmployee($data);
            echo json_encode(['success' => $result]);
        }
        break;
    case "PUT":
        if (preg_match("/^\/tasks\/(\d+)$/", $endpoint, $matches)) {
            //update employee by id
            $taskId = $matches[1];
            $data = json_decode(file_get_contents("php://input"), true);
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
