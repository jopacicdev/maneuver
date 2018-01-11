<?php

namespace Maneuver\Tests;

use Maneuver\Contracts\IRoute;
use Maneuver\Route;
use PHPUnit\Framework\TestCase;
use Maneuver\Fixtures\TestHandler;

class RouteTest extends TestCase
{
    /** @var Route */
    protected $route;

    protected function setUp()
    {
        $this->route = new Route(Route::GET, 'test', TestHandler::class);
    }

    public function testImplementsContract()
    {
        $this->assertInstanceOf(IRoute::class, $this->route);
    }

    public function testGetVerb()
    {
        $this->assertEquals(Route::GET, $this->route->getVerb());
    }

    public function testGetRoute()
    {
        $this->assertEquals('/test', $this->route->getRoute());
    }

    public function testGetHandler()
    {
        $this->assertEquals(TestHandler::class, $this->route->getHandler());
    }

    public function testHandle()
    {
        $this->route->handle();

        $this->expectOutputString('Handler Invoked!');
    }

    /**
     * @dataProvider validVerbs
     */
    public function testValidVerbs($verb)
    {
        $this->assertTrue(Route::isValid($verb));
    }

    /**
     * @dataProvider invalidVerbs
     */
    public function testInvalidVerbs($verb)
    {
        $this->assertFalse(Route::isValid($verb));
    }

    public function testCallStaticHandler()
    {
        $route = new Route(Route::GET, '/hello', '\Maneuver\Fixtures\TestHandler::staticHandler');

        $route->handle();
        $this->expectOutputString('Static Handler Invoked!');
    }

    public function testCallControllerAction()
    {
        $route = new Route(Route::GET, '/hello', '\Maneuver\Fixtures\TestHandler@indexAction');

        $route->handle();
        $this->expectOutputString('Controller Action Invoked!');
    }

    public function testCallCallable()
    {
        $route = new Route(Route::GET, '/hello', function() {
            echo 'Callable Invoked!';
        });

        $route->handle();
        $this->expectOutputString('Callable Invoked!');
    }

    public function validVerbs()
    {
        return [
            [Route::GET],
            [Route::POST],
            [Route::PUT],
            [Route::PATCH],
            [Route::DELETE],
        ];
    }

    public function invalidVerbs()
    {
        return [
            ['FAT'],
            ['PEST'],
            [''],
        ];
    }
}
