<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SearchControllerTest extends WebTestCase
{
    public function testSuccessSearch(): void
    {
        $client = static::createClient();

        $content = json_encode([
            "first_name" => "Мих",
            "last_name" => "Ива",
        ]);

        $client->request('GET', '/user/search', [], [], [], $content);

        $this->assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent());

        $this->assertEquals('Успешный поиск пользователя', $responseData->description);
    }

    public function testInvalidData(): void
    {
        $client = static::createClient();

        $content = json_encode([
            "first_name" => "Мих",
            "invalid_parameter" => "Ива",
        ]);

        $client->request('GET', '/user/search', [], [], [], $content);
        $response = $client->getResponse();

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseData = json_decode($response->getContent());

        $this->assertEquals('Невалидные данные', $responseData->description);
    }
}