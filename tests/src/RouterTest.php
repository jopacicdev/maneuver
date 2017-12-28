<?php

namespace Maneuver\Tests;

use Maneuver\Route;
use Maneuver\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /** @var Router */
    protected $router;

    protected function setUp()
    {
        $this->router = new Router();
    }

    public function testRegister()
    {
        $router = $this->router->register('GET', 'yolo', 'TestHandler');

        $this->assertInstanceOf(Router::class, $router);
    }

    public function testRegisterRouteWithGetMethod()
    {
        $router = $this->router->get('yolo', 'TestHandler');

        $this->assertInstanceOf(Router::class, $router);
    }

    public function testRegisterRouteWithPostMethod()
    {
        $router = $this->router->post('yolo', 'TestHandler');

        $this->assertInstanceOf(Router::class, $router);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRegisterWithInvalidVerb()
    {
        $this->router->register('FAT', 'yolo', 'TestHandler');
    }

    public function testHandle()
    {
        $_SERVER['REQUEST_METHOD'] = Route::POST;
        $_SERVER['REQUEST_URI'] = 'yolo';

        $router = $this->router->register('POST', 'yolo', TestHandler::class);
        $router->routeRequest();

        $this->assertInstanceOf(Router::class, $router);
    }

    public function testHandleWithNonRegisteredRouteVerb()
    {
        $_SERVER['REQUEST_METHOD'] = Route::POST;
        $_SERVER['REQUEST_URI'] = 'yolo';

        $router = $this->router->register(Route::GET, 'yolo', TestHandler::class);
        $response = $this->router->routeRequest();

        $this->assertInstanceOf(Router::class, $this->router);
        $this->assertFalse($response);
    }

    public function testHandleWithNonRegisteredRouteUri()
    {
        $_SERVER['REQUEST_METHOD'] = Route::POST;
        $_SERVER['REQUEST_URI'] = 'yolo';

        $router = $this->router->register(Route::POST, 'hai', TestHandler::class);
        $response = $this->router->routeRequest();

        $this->assertInstanceOf(Router::class, $this->router);
        $this->assertFalse($response);
    }
}

class TestHandler {
    public function __invoke()
    {
        echo 'Handler Invoked!';
    }
}