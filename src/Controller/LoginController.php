<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\User\UserPasswordHasher;
use Doctrine\ORM\EntityNotFoundException;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoginController extends AbstractController
{
    #[Route('/login', methods: ['POST'])]
    public function index(
        Request            $request,
        UserRepository     $userRepository,
        UserPasswordHasher $hasher,
        ValidatorInterface $validator,
    ): Response
    {
        $credentials = json_decode($request->getContent(), 'json');

        if (
            !(is_array($credentials)
                && array_key_exists('user_id', $credentials)
                && array_key_exists('password', $credentials)
                && count($validator->validate($credentials['user_id'], new Uuid())) === 0
                && $credentials['password'] != '')
        ) {
            return new Response(
                json_encode(['description' => 'Невалидные данные']),
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $userHashedPassword = $userRepository->getUserPassword($credentials['user_id']);
        } catch (EntityNotFoundException $e) {
            return new Response(
                json_encode(['description' => $e->getMessage()]),
                Response::HTTP_NOT_FOUND
            );
        }

        if (!$hasher->isPasswordValid($userHashedPassword, $credentials['password'])) {
            return new Response(
                json_encode(['description' => 'Авторизация невозможна']),
                Response::HTTP_NOT_FOUND
            );
        }

        $token = JWT::encode(
            [
                'iat' => time(),
                'nbf' => time(),
                'exp' => time() + 3600,
                'data' => ['user_id' => $credentials['user_id']]
            ],
            $_ENV['JWT_KEY'],
            'HS256'
        );

        $session = $request->getSession();
        $session->set('auth_token', $token);

        $response = new Response(
            json_encode([
                'description' => 'Успешная аутентификация',
                'token' => $token
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );

        $response->headers->setCookie(Cookie::create('token', $token));

        return $response;
    }
}
