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
    public function getFrameworks(FrameworkRepository $frameworkRepository, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
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
}
