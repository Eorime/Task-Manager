<?php
//common url file
require_once "curl_helper.php";
$restAPIBaseUrl = "http://localhost/REST-API";
try {
    //all tasks
    $tasks = sendRequest($restAPIBaseUrl . '/api.php/tasks/', 'GET');
    $tasks = json_decode($tasks, true);
    //task by id
    $taskId = 1;
    $task = sendRequest($restAPIBaseUrl . "/api.php/tasks/$taskId", "GET");
    $task = json_decode($task, true);
    //add new task
    $data = [
        '$task_title' => 'task_title',
        '$task_desc' => 'task_desc',
        //assigned to?
        '$task_dept' => 'task_dept',
        '$task_due' => 'task_due',
        '$task_status' => 'task_status',
        '$task_priority' => 'task_priority',
        '$task_created' => 'task_created',
        '$task_updated' => 'task_updated',
    ];
    $result = sendRequest($restAPIBaseUrl . "/api.php/tasks", "POST", $data);
    $result = json_decode($result, true);
    //update task 
    $taskId = 1;
    $data = [
        'task_title' => 'task_title',
        'task_desc' => 'task_desc',
        'task_dept' => 'task_dept',
        'task_due' => 'task_due',
        'task_status' => 'task_status',
        'task_priority' => 'task_priority',
        'task_updated' => "NOW()"
    ];
    $result = sendRequest($restAPIBaseUrl . "/api.php/tasks/$taskId", "PUT", $data);
} catch (Exception $e) {
    echo $e;
}