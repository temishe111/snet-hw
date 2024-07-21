<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/user/search', methods: ['GET'])]
    public function getUserProfile(Request $request, UserRepository $userRepository): Response
    {
        $searchParameters = json_decode($request->getContent());
        $isSearchParametersValid = isset($searchParameters->first_name)
            && isset($searchParameters->last_name);

        if (!$isSearchParametersValid) {
            return new Response(
                json_encode(['description' => 'Невалидные данные']),
                Response::HTTP_BAD_REQUEST
            );
        }


        $users = $userRepository->searchUserByName($searchParameters->first_name, $searchParameters->last_name);

        return new Response(
            json_encode([
                'description' => 'Успешный поиск пользователя',
                'users' => $users,
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}