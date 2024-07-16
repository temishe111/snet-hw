<?php

namespace App\Controller\User;

use App\Entity\User\User;
use App\Service\User\UserCreator;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterController extends AbstractController
{
    /**
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param UserCreator $userCreator
     * @return Response
     * @throws Exception
     */
    #[Route('/user/register', methods: ['POST'])]
    public function registerNewUser(
        Request             $request,
        SerializerInterface $serializer,
        ValidatorInterface  $validator,
        UserCreator         $userCreator,
    ): Response
    {

        $user = $serializer->deserialize($request->getContent(), User::class, 'json');

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return new Response(
                json_encode(['description' => 'Невалидные данные: ' . $errors]),
                Response::HTTP_BAD_REQUEST
            );
        }

        $user_id = $userCreator->create($user);

        return new Response(
            json_encode([
                'description' => 'Успешная регистрация',
                'content' => ['user_id' => $user_id]
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
