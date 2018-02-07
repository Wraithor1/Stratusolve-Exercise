<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script

$taskId = $_POST['taskId'];
$taskName = $_POST['taskName'];
$taskDescription = $_POST['taskDescription'];

if ($taskId != -1)
{
    $task = new Task($taskId);
}
else
{
    $task = new Task();
}

if ($_POST['deleteTask'] == 'true')
{
    $task->delete();
}
else
{
    $task->save($taskName, $taskDescription, $taskId);
}


?>