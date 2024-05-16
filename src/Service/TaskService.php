<?php

namespace App\Service;

use App\Model\Task;
use App\Serializer\TaskSerializer;

class TaskService
{

    private $todoSerializer;

    public function __construct(
        TaskSerializer $todoSerializer
    )
    {
        $this->todoSerializer = $todoSerializer;
    }

    public function getAllTasks()
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        return $this->todoSerializer->deserialize($fileContent);
    }

    public function addTask($newTask)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $storedData = json_decode($fileContent, true);

        $storedData[] = $newTask;
        file_put_contents(__DIR__ . '/../Data/db.json', json_encode($storedData));
        return true;

    }

    public function removeTodo($taskId)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $storedData = json_decode($fileContent, true);


        foreach ($storedData as $key => $task) {
            if ($task['id'] == $taskId) {
                unset($storedData[$key]);
                break;
            }
        }

        $jsonData = json_encode(array_values($storedData), JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . '/../Data/db.json', $jsonData);


    }

    public function updateTask($actualTask)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $storedData = json_decode($fileContent, true);

        foreach ($storedData as &$task) {
            if ($task['id'] === $actualTask['id']) {
                $task['title'] = $actualTask['title'];
                $task['description'] = $actualTask['description'];
                $task['status'] = $actualTask['status'];
                $task['priority'] = $actualTask['priority'];
                break;
            }
        }

        file_put_contents(__DIR__ . '/../Data/db.json', json_encode($storedData, JSON_PRETTY_PRINT));

    }

}