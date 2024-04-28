<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProjectRepository;
use App\Repository\TypeRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Project;
use App\Entity\Framework;
use App\Entity\Language;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    #[Route('/api/projects', methods: ['GET'], name: 'project_get')]
    public function getProjects(ProjectRepository $projectRepository): JsonResponse
    {
        $projects = $projectRepository->findAll();

        $response = array_map(
            fn (Project $project) => [
                'id' => $project->getId(),
                'title' => $project->getTitle(),
                'description' => $project->getDescription(),
                'content' => $project->getContent(),
                'url' => $project->getUrl(),
                'github' => $project->getGithub(),
                'date' => $project->getDate(),
                'thumbnail' => $project->getThumbnail(),
                'frameworks' => $project->getFrameworks()->map(
                    fn (Framework $framework) => [
                        'id' => $framework->getId(),
                        'name' => $framework->getName(),
                    ]
                )->toArray(),
                'languages' => $project->getLanguages()->map(
                    fn (Language $language) => [
                        'id' => $language->getId(),
                        'name' => $language->getName(),
                        'shortName' => $language->getShortName(),
                    ]
                )->toArray(),
                'type' => [
                    'id' => $project->getType()->getId(),
                    'name' => $project->getType()->getName(),
                ],
                'category' => [
                    'id' => $project->getCategory()->getId(),
                    'name' => $project->getCategory()->getName(),
                ],
                'classe' => $project->getClasse() !== null ? [
                    'id' => $project->getClasse()->getId(),
                    'name' => $project->getClasse()->getName(),
                ] : null,
            ],
            $projects
        );

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $response,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK
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

        $response = [
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'content' => $project->getContent(),
            'url' => $project->getUrl(),
            'github' => $project->getGithub(),
            'date' => $project->getDate(),
            'thumbnail' => $project->getThumbnail(),
            'frameworks' => $project->getFrameworks()->map(
                fn (Framework $framework) => [
                    'id' => $framework->getId(),
                    'name' => $framework->getName(),
                ]
            )->toArray(),
            'languages' => $project->getLanguages()->map(
                fn (Language $language) => [
                    'id' => $language->getId(),
                    'name' => $language->getName(),
                    'shortName' => $language->getShortName(),
                ]
            )->toArray(),
            'type' => [
                'id' => $project->getType()->getId(),
                'name' => $project->getType()->getName(),
            ],
            'category' => [
                'id' => $project->getCategory()->getId(),
                'name' => $project->getCategory()->getName(),
            ],
            'classe' => $project->getClasse() !== null ? [
                'id' => $project->getClasse()->getId(),
                'name' => $project->getClasse()->getName(),
            ] : null
        ];

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $response,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK
        );
    }

    #[Route('/api/projects', methods: ['POST'], name: 'project_create')]
    public function createProject(Request $request, EntityManagerInterface $em, SerializerInterface $serializer, TypeRepository $typeRepository, CategoryRepository $categoryRepository): JsonResponse
    {
        try{
            $data = json_decode($request->getContent(), true);
            $project = $serializer->deserialize($request->getContent(), Project::class, 'json');
            
            $project->setType($typeRepository->find($data["type_id"]));
            $project->setCategory($categoryRepository->find($data["category_id"]));

            $em->persist($project);
            $em->flush();
            
            return $this->json(
                [
                    "status" => 201,
                    "success" => true,
                    "data" => $project,
                    "message" => "Created with success"
                ], 
                Response::HTTP_CREATED, [], ['groups' => 'getProjects']
            );
        }
        catch(\Exception $e){
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
}