<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\FrameworkRepository;
use App\Entity\Framework;
use Exception;

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

    #[Route('/api/frameworks', methods: ['POST'], name: 'framework_create')]
    public function createFramework(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        try{
            $framework = $serializer->deserialize($request->getContent(), Framework::class, 'json');

            $em->persist($framework);
            $em->flush();
            
            return $this->json(
                [
                    "status" => 201,
                    "success" => true,
                    "data" => $framework,
                    "message" => "Created with success"
                ], 
                Response::HTTP_CREATED, [], ['groups' => 'getFrameworks']
            );
        }
        catch(Exception $e){
            return $this->json(
                [
                    "status" => 400,
                    "success" => false,
                    "message" => $e->getMessage()
                ], 
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/api/frameworks/{id}', methods: ['DELETE'], name: 'framework_delete')]
    public function deleteFramework(int $id, FrameworkRepository $frameworkRepository, EntityManagerInterface $em): JsonResponse
    {
        $framework = $frameworkRepository->find($id);

        if (!$framework){
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Framework with id $id does not exist"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        $em->remove($framework);
        $em->flush();

        return $this->json(
            [
                "status" => 204,
                "success" => true,
                "message" => "Deleted with success"
            ], 
            Response::HTTP_NO_CONTENT
        );
    }
    
}