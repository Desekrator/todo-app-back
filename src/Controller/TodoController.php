<?php

namespace App\Controller;


use App\Model\Task;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{

    private TaskService $taskService;

    public function __construct(TaskService $todoService)
    {
        $this->taskService = $todoService;
    }

    /**
     * @Route("/task",methods={"GET"})
     */
    public function getAllTasks(TaskService $taskService)
    {
        return $this->json($taskService->getAllTodos());
    }

    /**
     * @Route("/addTask",methods={"GET", "POST"})
     */
    public function addTask(Request $request, TaskService $taskService)
    {
        $data = json_decode($request->getContent(), true);
        return $this->json($taskService->addTodo($data), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @Route("/task/{id}",methods={"DELETE"})
     */
    public function removeTask($id, TaskService $taskService)
    {
        return $this->json($taskService->removeTodo($id));
    }

    /**
     * @Route("/editTask",methods={"GET","POST"})
     */
    public function editTask(Request $request, TaskService $taskService)
    {
        $requestData = json_decode($request->getContent(), true);

        $taskService->updateTodo($requestData);
        return $this->json("Edit correct");
    }
}