<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\UseCase\CreateTaskUseCase;
use App\Application\UseCase\DeleteTaskUseCase;
use App\Application\UseCase\GetTasksUseCase;
use App\Application\UseCase\UpdateTaskUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', methods: ['POST'])]
    public function create(Request $request, CreateTaskUseCase $createTaskUseCase): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['title']) || !is_string($data['title'])) {
            return $this->json(['error' => 'Title is required and must be a string'], Response::HTTP_BAD_REQUEST);
        }

        $task = $createTaskUseCase($data['title'], $data['description'] ?? null);

        return $this->json($task, Response::HTTP_CREATED);
    }

    #[Route('/tasks', methods: ['GET'])]
    public function list(GetTasksUseCase $getTasksUseCase): JsonResponse
    {
        return $this->json($getTasksUseCase());
    }

    #[Route('/tasks/{id}', methods: ['PUT'])]
    public function update(
        string $id,
        Request $request,
        UpdateTaskUseCase $updateTaskUseCase
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        try {
            $task = $updateTaskUseCase($id, $data['title'] ?? null, $data['description'] ?? null);
            return $this->json($task);
        } catch (\InvalidArgumentException $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/tasks/{id}', methods: ['DELETE'])]
    public function delete(string $id, DeleteTaskUseCase $deleteTaskUseCase): JsonResponse
    {
        try {
            $deleteTaskUseCase($id);
            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
