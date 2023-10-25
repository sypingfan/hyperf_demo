<?php
/**
 * 中间件
 * 中间件主要用户编制从请求（Request）到响应（Response）的整个流程，
 * 通过对多个中间件的组织，使数据的流动按我们预定的方式进行，中间件的本质是一个洋葱模型
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/20
 * Time: 22:20
 */

namespace App\Controller;

use App\Middleware\BarMiddleware;
use App\Middleware\BazMiddleware;
use App\Middleware\FooMiddleware;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Contract\RequestInterface;

#[AutoController]
#[Middlewares([

    BarMiddleware::class,
    BazMiddleware::class
])]
class MiddController
{

    #[Middleware(FooMiddleware::class)]
    public function index(RequestInterface $request)
    {
       $fooValue =  $request->getAttribute("foo");
       var_dump($fooValue);
        return "index";
    }
}