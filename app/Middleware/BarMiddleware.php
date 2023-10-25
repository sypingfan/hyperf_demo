<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/20
 * Time: 22:15
 */

namespace App\Middleware;



use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BarMiddleware implements MiddlewareInterface
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        echo 2;
        var_dump($request->getAttribute("foo"));
        $response = $handler->handle($request);
        echo 5;
        return $response;
    }
}