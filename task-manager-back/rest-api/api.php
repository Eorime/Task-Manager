<?php
require_once "config.php";
require_once "task.php";
require_once "employee.php";
require_once "priority.php";
require_once "department.php";
require_once "status.php";

//instance the classes
$taskObject = new Task($connection);
$employeeObject = new Employee($connection);
$priorityObject = new Priority($connection);
$departmentObject = new Department($connection);
$statusObject = new Status($connection);

//get request method
$method = $_SERVER["REQUEST_METHOD"];
//get the requested endpoint
$endpoint = $_SERVER["PATH_INFO"];
//set content type of the request
header("Content-type: application/json");

// Authentication function
function authenticate()
{
    $headers = getallheaders();
    $token = $headers["Authorization"] ?? $_POST['token'] ?? $_GET['token'] ?? null;

    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => "Authentication required"]);
        exit;
    }

    $token = str_replace('Bearer ', '', $token);
    $token = trim($token);

    $user = validateToken($token);
    if (!$user) {
        http_response_code(401);
        echo json_encode(['error' => "Invalid credentials"]);
        exit;
    }
    return $user;
}

$protected_routes = [
    'POST' => ['/tasks'],
    'PUT' => ['/tasks'],
    'DELETE' => ['/tasks', '/employees']
];

$current_user = null;
if (isset($protected_routes[$method])) {
    foreach ($protected_routes[$method] as $protected_route) {
        if (strpos($endpoint, $protected_route) === 0) {
            $current_user = authenticate();
            break;
        }
    }
}

//process the request 
switch ($method) {
    case "GET":
        //task(s) GET
        if ($endpoint === "/tasks") {
            //get all tasks
            $tasks = $taskObject->getAllTasks();
            echo json_encode(['tasks' => $tasks, 'message' => 'Tasks retrieved successfully']);
        } elseif (preg_match('/^\/tasks\/(\d+)$/', $endpoint, $matches)) {
            $taskId = $matches[1];
            $task = $taskObject->getTaskById($taskId);
            echo json_encode($task ? ['task' => $task] : ['error' => 'Task not found']);

            //employee(s) GET   
        } elseif ($endpoint === "/employees") {
            $employees = $employeeObject->getAllEmployees();
            echo json_encode(['employees' => $employees]);
        } elseif (preg_match('/^\/employees\/(\d+)$/', $endpoint, $matches)) {
            $employeeId = $matches[1];
            $employee = $employeeObject->getEmployeeById($employeeId);
            echo json_encode($employee ? ['employee' => $employee] : ['error' => 'Employee not found']);

        } elseif ($endpoint === "/statuses") {
            $statuses = $statusObject->getAllStatuses();
            echo json_encode(['statuses' => $statuses]);
        } elseif ($endpoint === "/departments") {
            $departments = $departmentObject->getAlldepartments();
            echo json_encode(['departments' => $departments]);
        } elseif ($endpoint === "/priorities") {
            $priorities = $priorityObject->getAllpriorities();
            echo json_encode(['priorities' => $priorities]);
        }
        break;

    case "POST":
        //auth
        if ($endpoint === "/login") {
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data === null) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
                break;
            }

            if (!isset($data['email']) || !isset($data['password'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Email and password are required']);
                break;
            }

            $email = $data['email'];
            $password = $data['password'];

            $user = $employeeObject->login($email, $password);
            if ($user) {
                $token = generateToken($user['id']);
                echo json_encode(['success' => true, 'token' => $token, 'user' => $user]);
            } else {
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
            }
        } elseif ($endpoint === "/signup") {
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data === null) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
                break;
            }

            $result = $employeeObject->addEmployee($data);
            echo json_encode(['success' => $result]);
            //task addition
        } elseif ($endpoint === "/tasks") {
            //add a new task
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data === null) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
                break;
            }

            $result = $taskObject->addTask($data, $current_user['id']);
            echo json_encode(["success" => $result]);

            //employee addition
        } elseif ($endpoint === "/employees") {
            $data = json_decode(file_get_contents("php://input"), true);

            if ($data === null) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
                break;
            }

            $result = $employeeObject->addEmployee($data);
            echo json_encode(['success' => $result]);
        }
        break;

    case "PUT":
        if (preg_match("/^\/tasks\/(\d+)$/", $endpoint, $matches)) {
            //update task by id
            $taskId = $matches[1];
            $data = json_decode(file_get_contents("php://input"), true);

            // check if json was parsed successfully
            if ($data === null) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid JSON format']);
                break;
            }

            $result = $taskObject->updateTask($taskId, $data, $current_user['id']);
            echo json_encode(['success' => $result]);
        }
        break;

    case "DELETE":
        if (preg_match("/^\/tasks\/(\d+)$/", $endpoint, $matches)) {
            //delete task by id 
            $taskId = $matches[1];
            $result = $taskObject->deleteTask($taskId, $current_user['id']);
            echo json_encode(['success' => $result]);
        } elseif (preg_match("/^\/employees\/(\d+)$/", $endpoint, $matches)) {
            $employeeId = $matches[1];
            $result = $employeeObject->deleteEmployee($employeeId);
            echo json_encode(['success' => $result]);
        }
        break;
}