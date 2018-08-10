<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterRouteTest extends WebTestCase
{
    public function testRegisterRoute()
    {
        $client = static::createClient();

        $client->request('GET', '/register/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
