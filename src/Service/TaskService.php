<?php

namespace App\Service;

use App\Model\Task;
use App\Serializer\TaskSerializer;

class TaskService
{
    private $taskSerializer;
    private $dataFilePath;

    public function __construct(TaskSerializer $taskSerializer, string $dataFilePath)
    {
        $this->taskSerializer = $taskSerializer;
        $this->dataFilePath = $dataFilePath;
    }

    public function getAllTasks(): array
    {
        $fileContent = file_get_contents($this->dataFilePath);
        return $this->taskSerializer->deserialize($fileContent);
    }

    public function addTask(Task $newTask): bool
    {
        $storedData = $this->loadDataFromFile();

        $storedData[] = $newTask->toArray();
        $this->saveDataToFile($storedData);

        return true;
    }

    public function removeTask(string $taskId): bool
    {
        $storedData = $this->loadDataFromFile();
        $isTaskDeleted = false;
        foreach ($storedData as $key => $task) {
            if ($task['id'] == $taskId) {
                unset($storedData[$key]);
                $isTaskDeleted = true;
                break;
            }
        }

        $this->saveDataToFile(array_values($storedData));

        return $isTaskDeleted;
    }

    public function updateTask(Task $updatedTask): bool
    {
        $storedData = $this->loadDataFromFile();

        $isTaskUpdated = false;
        foreach ($storedData as &$task) {
            if ($task['id'] === $updatedTask->getId()) {
                $task = $updatedTask->toArray();
                $isTaskUpdated = true;
                break;
            }
        }

        $this->saveDataToFile($storedData);

        return $isTaskUpdated;
    }

    private function loadDataFromFile(): array
    {
        $fileContent = file_get_contents($this->dataFilePath);
        return json_decode($fileContent, true) ?: [];
    }

    private function saveDataToFile(array $data): void
    {
        file_put_contents($this->dataFilePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}