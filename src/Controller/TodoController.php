<?php

namespace App\Controller;


use App\Model\Task;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        return $this->json($taskService->getAllTasks());
    }

    /**
     * @Route("/addTask",methods={"GET", "POST"})
     */
    public function addTask(Request $request, TaskService $taskService)
    {
        $data = json_decode($request->getContent(), true);

        $addedTask = $taskService->addTask(Task::fromArray($data));

        if ($addedTask) {
            return new JsonResponse(['message' => 'Task updated successfully']);
        }

        return new JsonResponse(['message' => 'Task not created'], 404);
    }

    /**
     * @param $id
     * @Route("/task/{id}",methods={"DELETE"})
     */
    public function removeTask($id, TaskService $taskService)
    {
        $isTaskDeleted = $taskService->removeTask($id);
        if ($isTaskDeleted) {
            return new JsonResponse(['message' => 'Task deleted successfully']);
        }

        return new JsonResponse(['message' => 'Task not deleted']);
    }

    /**
     * @Route("/editTask",methods={"GET","POST"})
     */
    public function editTask(Request $request, TaskService $taskService)
    {
        $requestData = json_decode($request->getContent(), true);

        $isTaskUpdated = $taskService->updateTask(Task::fromArray($requestData));

        if ($isTaskUpdated) {
            return new JsonResponse(['message' => 'Task updated successfully']);
        }

        return new JsonResponse(['message' => 'Task not updated'], 404);
    }
}