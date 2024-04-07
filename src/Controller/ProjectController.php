<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProjectRepository;

class ProjectController extends AbstractController
{
    #[Route('/api/projects', methods: ['GET'], name: 'project_get')]
    public function getProjects(ProjectRepository $projectRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $projectRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getProjects']
        );
    }

    #[Route('/api/projects/{id}', methods: ['GET'], name: 'project_get_one')]
    public function getProject(int $id, ProjectRepository $projectRepository): JsonResponse
    {
        $project = $projectRepository->find($id);

        if (!$project) {
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Project with id $id does not exit"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $project,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getProjects']
        );
    }
}
