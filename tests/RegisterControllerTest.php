<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegisterControllerTest extends WebTestCase
{
    public function testSuccessRegister(): void
    {
        $client = static::createClient();

        $content = json_encode([
            "first_name" => "Михаил",
            "second_name" => "Иванов",
            "birthdate" => "1990-05-14",
            "biography" => "Люблю программировать, заниматься спортом и читать книги.",
            "city" => "Москва",
            "password" => "password123",
        ]);

        $client->request('POST', '/user/register', [], [], [], $content);

        $this->assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent());

        $this->assertEquals('Успешная регистрация', $responseData->description);
    }

    public function testUserRegisterInvalidData(): void
    {
        $client = static::createClient();

        $content = json_encode([
            "first_name" => "Михаил",
            "second_name" => "Иванов",
            "birthdate" => "invalid_data",
            "biography" => "Люблю программировать, заниматься спортом и читать книги.",
            "city" => "Москва",
            "password" => "password123",
        ]);

        $client->request('POST', '/user/register', [], [], [], $content);
        $response = $client->getResponse();

        $responseData = json_decode($response->getContent());
        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $this->assertStringContainsString('Невалидные данные', $responseData->description);
    }
}
