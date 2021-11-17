<?php
use taskForce\main\Task;
require_once('vendor/autoload.php');

$task = new Task(25, 44, "status_inwork");

echo "Текущий статус:  ";
print_r($task->getStatus());
echo "<br>";

echo "все доступные статусы: ";
print_r($task->getAllStatuses());
echo "<br>";

echo "все доступные действия: ";
print_r($task->getAvailableActions());
echo "<br>";

echo "статус, в который перейдёт задание после выполнения конкретного действия: ";
print_r($task->getNextStatus('action_performed'));
echo "<br>";

echo "список доступных действий в текущем статусе :";
$task->getAvailableStatuses();
echo "<br>";