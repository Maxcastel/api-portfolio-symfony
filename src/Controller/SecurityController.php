<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SecurityController extends AbstractController
{
    private $tokenStorageInterface;
    private $jwtManager;

    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager)
    {
        $this->tokenStorageInterface  = $tokenStorageInterface;
        $this->jwtManager = $jwtManager;
    }

    #[Route('/api/isAuth', methods: ['GET'], name: 'api_isAuth')]
    public function isAuth(): JsonResponse
    {
        return $this->json(
            [   
                "code" => 200,
                "isAuth " => true
            ], 
            Response::HTTP_OK
        );
    }

}
