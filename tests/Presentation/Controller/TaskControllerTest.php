<?php

declare(strict_types=1);

namespace App\Tests\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testListTasks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/tasks');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');

        $responseContent = $client->getResponse()->getContent();
        $this->assertJson($responseContent);

        $tasks = json_decode($responseContent, true);
        $this->assertIsArray($tasks);
        $this->assertCount(0, $tasks);
    }

    public function testCreateTask(): void
    {
        $client = static::createClient();

        $client->request('POST', '/tasks', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'title' => 'New Task',
            'description' => 'Task Description',
        ]));

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $response);
        $this->assertSame('New Task', $response['title']);
        $this->assertSame('Task Description', $response['description']);
    }
}
