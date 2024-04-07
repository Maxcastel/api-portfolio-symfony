<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\LanguageRepository;
use App\Entity\Language;

class LanguageController extends AbstractController
{
    #[Route('/api/languages', methods: ['GET'], name: 'language_get')]
    public function getLanguages(LanguageRepository $languageRepository): JsonResponse
    {
        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $languageRepository->findAll(),
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK, [], ['groups' => 'getLanguages']
        );
    }
}
