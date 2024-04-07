<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TypeRepository;

class TypeController extends AbstractController
{
    #[Route('/api/types', methods: ['GET'], name: 'type_get')]
    public function getTypes(TypeRepository $typeRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $typeRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getTypes']
        );
    }

    #[Route('/api/types/{id}', methods: ['GET'], name: 'type_get_one')]
    public function getType(int $id, TypeRepository $typeRepository): JsonResponse
    {
        $type = $typeRepository->find($id);
        if (!$type) {
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Type with id $id does not exist"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $type,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getTypes']
        );
    }
}
