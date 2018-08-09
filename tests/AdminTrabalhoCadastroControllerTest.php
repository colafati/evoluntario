<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminTrabalhoCadastroControllerTest extends WebTestCase
{
    public function testAdminTrabalhoCadatroRota()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/trabalho/cadastro');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
