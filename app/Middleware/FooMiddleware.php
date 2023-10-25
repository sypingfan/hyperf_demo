<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/20
 * Time: 22:15
 */

namespace App\Middleware;



use Hyperf\Context\Context;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FooMiddleware implements MiddlewareInterface
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        echo 1;
        // 放入协程上下文中可以在控制器中使用
        $request =  Context::override(ServerRequestInterface::class,function ()use($request){
            return $request->withAttribute("foo",1);
        });
//        $request =  $request->withAttribute("foo",1);
        $response =  $handler->handle($request);
        echo 4;
        $body = $response->getBody()->getContents();
        return $response->withBody(new SwooleStream($body."foo"));

    }
}