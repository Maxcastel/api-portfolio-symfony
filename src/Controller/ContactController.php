<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Exception;

class ContactController extends AbstractController
{
    #[Route('/api/email', methods: ['POST'], name: 'send_email')]
    public function sendEmail(MailerInterface $mailer, Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        try{
            $data = json_decode($request->getContent(), true);

            $message = $serializer->deserialize($request->getContent(), Contact::class, 'json');

            $email = (new Email())
                ->from($data["email"])
                ->to('maxence.castel59@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($data["subject"])
                // ->text('Sending emails is fun again!')
                ->html($data["message"]);

            $mailer->send($email);

            $em->persist($message);
            $em->flush();

            return $this->json(
                [
                    "status" => 200,
                    "success" => true,
                    "data" => $message,
                    "message" => "Email send with success"
                ], 
                Response::HTTP_OK
            );
        }
        catch(Exception $e){
            return $this->json(
                [
                    "status" => 500,
                    "success" => false,
                    "message" => $e->getMessage()
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    #[Route('/api/emails', methods: ['GET'], name: 'emails_get')]
    public function getEmails(ContactRepository $contactRepository): JsonResponse
    {
        $emails = $contactRepository->findAll();

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $emails,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK
        );
    }

    #[Route('/api/emails/{id}', methods: ['GET'], name: 'emails_get_one')]
    public function getEmail(int $id, ContactRepository $contactRepository): JsonResponse
    {
        $email = $contactRepository->find($id);

        if (!$email) {
            return $this->json(
                [
                    "status" => 404,
                    "success" => false,
                    "message" => "Email with id $id does not exist"
                ], 
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            [
                "status" => 200,
                "success" => true,
                "data" => $email,
                "message" => "Operation completed with success"
            ], 
            Response::HTTP_OK
        );
    }
}
