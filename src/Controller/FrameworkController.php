<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\FrameworkRepository;

class FrameworkController extends AbstractController
{
    #[Route('/api/frameworks', methods: ['GET'], name: 'framework_get')]
    public function getFrameworks(FrameworkRepository $frameworkRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $frameworkRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getFrameworks']
        );
    }

    #[Route('/api/frameworks/{id}', methods: ['GET'], name: 'framework_get_one')]
    public function getFramework(int $id, FrameworkRepository $frameworkRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $frameworkRepository->find($id),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getFrameworks']
        );
    }
}