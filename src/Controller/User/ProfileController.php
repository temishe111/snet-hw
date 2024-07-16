<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileController extends AbstractController
{
    #[Route('/user/get/{id}', methods: ['GET'])]
    public function getUserProfile(string $id, UserRepository $userRepository, ValidatorInterface $validator): Response
    {
        $errors = $validator->validate($id, new Uuid());

        if (count($errors) > 0) {
            return new Response(
                json_encode(['description' => 'Невалидные данные']),
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $user = $userRepository->getUserProfile($id);
        } catch (EntityNotFoundException $e) {
            return new Response(
                json_encode(['description' => $e->getMessage()]),
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            json_encode([
                'description' => 'Успешное получение анкеты пользователя',
                'content' => $user,
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
