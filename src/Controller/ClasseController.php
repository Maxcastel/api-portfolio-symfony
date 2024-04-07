<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ClasseRepository;

class ClasseController extends AbstractController
{
    #[Route('/api/classes', methods: ['GET'], name: 'classe_get')]
    public function getClasses(ClasseRepository $classeRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $classeRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getClasses']
        );
    }

    #[Route('/api/classes/{id}', methods: ['GET'], name: 'classe_get_one')]
    public function getClasse(int $id, ClasseRepository $classeRepository): JsonResponse
    {
        $classe = $classeRepository->find($id);
        if (!$classe) {
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Classe with id $id not found"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $classe,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getClasses']
        );
    }
}
