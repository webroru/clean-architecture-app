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
}
