<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProfileControllerTest extends WebTestCase
{
    public function testGetUserSuccess(): void
    {
        $client = static::createClient();

        $client->request('GET', '/user/get/01907e60-8a09-75a2-b001-3a040801f6e4');

        $this->assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent());

        $this->assertEquals('Успешное получение анкеты пользователя', $responseData->description);
    }

    public function testGetUserInvalidData(): void
    {
        $client = static::createClient();

        $client->request('GET', '/user/get/invalid_guid');
        $response = $client->getResponse();

        $responseData = json_decode($response->getContent());
        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $this->assertEquals('Невалидные данные', $responseData->description);
    }

    public function testGetUserNotFound(): void
    {
        $client = static::createClient();

        $client->request('GET', '/user/get/01907869-61c3-77a5-bbfe-cb37032dcdf5');
        $response = $client->getResponse();

        $responseData = json_decode($response->getContent());
        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());

        $this->assertEquals('Пользователь не найден', $responseData->description);
    }
}
