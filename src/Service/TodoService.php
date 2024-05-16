<?php

namespace App\Service;

use App\Model\Todo;
use App\Serializer\TodoSerializer;

class TodoService
{

    private $todoSerializer;

    public function __construct(
        TodoSerializer $todoSerializer
    )
    {
        $this->todoSerializer = $todoSerializer;
    }

    public function getAllTodos()
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/todos.json');
        return $this->todoSerializer->deserialize($fileContent);
    }

    public function addTodo($todo)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/todos.json');
        $data = json_decode($fileContent, true);

        $data[] = $todo;
        file_put_contents(__DIR__ . '/../Data/todos.json', json_encode($data));
        return true;

    }

    public function removeTodo($id)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/todos.json');
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
        file_put_contents(__DIR__ . '/../Data/todos.json', $jsonData);


    }

    public function updateTodo($new)
    {
        $fileContent = file_get_contents(__DIR__ . '/../Data/todos.json');
        $data = json_decode($fileContent, true);

//        var_dump($this->todoSerializer->deserialize($fileContent));
//        $newTodo = [
//            'id' => $data['id'],
//            'title' => $data['title'],
//            'description' => $data['description'],
//            'status' => $data['status'],
//            'priority' => $data['priority']
//        ];
//
//        $indexToUpdate = null;
//        foreach ($data as $index => $item) {
//            if ($item['id'] == $data['id']) {
//                $indexToUpdate = $index;
//                break;
//            }
//        }
//        $data[$indexToUpdate] = $newTodo;
//
//        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
//
//        file_put_contents(__DIR__ . '/../Data/todos.json', $jsonData);
        var_dump($new);
    }

}