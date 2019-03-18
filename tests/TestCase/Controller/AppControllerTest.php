<?php

namespace Rx\Test\TestCase\Controller;

use Cake\Http\ServerRequest;
use Rx\Controller\AppController;
use PHPUnit\Framework\TestCase;

class AppControllerTest extends TestCase
{

    public function testInitialize()
    {
        $controller = new AppController();

        $components = $controller->components()->loaded();
        $this->assertEquals(['RequestHandler', 'Flash'], $components);
    }
}
