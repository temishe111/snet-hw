<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase
{
    public function testSuccessLogin(): void
    {
        $client = static::createClient();

        $content = json_encode([
            'user_id' => '01907e60-8a09-75a2-b001-3a040801f6e4',
            'password' => 'password123',
        ]);

        $client->request('POST', '/login', [], [], [], $content);

        $this->assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent());

        $this->assertEquals('Успешная аутентификация', $responseData->description);
    }

    public function testInvalidData(): void
    {
        $client = static::createClient();

        $content = json_encode([
            'user_id' => 'invalid_guid',
            'password' => 'password123',
        ]);

        $client->request('POST', '/login', [], [], [], $content);
        $response = $client->getResponse();

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseData = json_decode($response->getContent());

        $this->assertEquals('Невалидные данные', $responseData->description);
    }

    public function testUserNotFound(): void
    {
        $client = static::createClient();

        $content = json_encode([
            'user_id' => '01907e3b-4bde-715c-bb5d-95c400123660',
            'password' => 'password123',
        ]);

        $client->request('POST', '/login', [], [], [], $content);
        $response = $client->getResponse();

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $responseData = json_decode($response->getContent());

        $this->assertEquals('Пользователь не найден', $responseData->description);
    }
}
