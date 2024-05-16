<?php

namespace App\Controller;


use App\Model\Todo;
use App\Service\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{

    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * @Route("/todo",methods={"GET"})
     */
    public function getAllTodos(TodoService $todo)
    {
        return $this->json($todo->getAllTodos());
    }

    /**
     * @Route("/addTodo",methods={"GET", "POST"})
     */
    public function addTodo(Request $request, TodoService $todo)
    {
        $data = json_decode($request->getContent(), true);
        return $this->json($todo->addTodo($data));
    }

    /**
     * @param $id
     * @Route("/todo/{id}",methods={"DELETE"})
     */
    public function removeTodo($id, TodoService $todo)
    {

//        var_dump($id);

//        $todo->removeTodo($id);
//        echo($this->json($todo->getAllTodos()));
        return $this->json($todo->removeTodo($id));
    }

    /**
     * @Route("/editTodo",methods={"PUT"})
     */
    public function editTodo(Request $request, TodoService $todo)
    {

        $data = json_decode($request->getContent(), true);
        $todo->updateTodo();
//        return $this->json($todo->getAllTodos());
    }
}