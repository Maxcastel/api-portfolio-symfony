<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    #[Route('/api/category', methods: ['GET'], name: 'category_get')]
    public function getCategories(CategoryRepository $categoryRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $categoryRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getCategory']
        );
    }

    #[Route('/api/category/{id}', methods: ['GET'], name: 'category_get_one')]
    public function getCategory(int $id, CategoryRepository $categoryRepository): JsonResponse
    {
        $category = $categoryRepository->find($id);
        if (!$category){
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Category with id $id does not exist"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $category,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getCategory']
        );
    }
}
