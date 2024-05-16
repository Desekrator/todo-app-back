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

    public function getAllTodos()
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        return $this->todoSerializer->deserialize($fileContent);
    }

    public function addTodo($todo)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $data = json_decode($fileContent, true);

        $data[] = $todo;
        file_put_contents(__DIR__ . '/../Data/db.json', json_encode($data));
        return true;

    }

    public function removeTodo($id)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $data = json_decode($fileContent, true);


        foreach ($data as $key => $producto) {
            if ($producto['id'] == $id) {
                unset($data[$key]);
                break;
            }
        }

//        return $ok;
        $jsonData = json_encode(array_values($data), JSON_PRETTY_PRINT);
//
        file_put_contents(__DIR__ . '/../Data/db.json', $jsonData);


    }

    public function updateTodo($actualTodo)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/db.json');
        $data = json_decode($fileContent, true);

        foreach ($data as &$todo) {
            if ($todo['id'] === $actualTodo['id']) {
                $todo['title'] = $actualTodo['title'];
                $todo['description'] = $actualTodo['description'];
                $todo['status'] = $actualTodo['status'];
                $todo['priority'] = $actualTodo['priority'];
                break;
            }
        }

        file_put_contents(__DIR__ . '/../Data/db.json', json_encode($data, JSON_PRETTY_PRINT));

    }

}