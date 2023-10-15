<?php
/**
 * 协程
 * 进程无论类里面的属性是不是静态数据，它都会在进程全局类共享，
 * 协程:把状态值放到协程上下文中，这样就不会造成数据混淆，协程上下文会在协程结束后自动释放，所以也无需担忧内存泄露的问题
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/15
 * Time: 15:27
 */

namespace App\Controller;

use App\Coroutine\Co;
use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;

#[AutoController]
class CoController
{
    #[Inject(Co::class)]
    private $co;

    public function get()
    {
        return $this->co->bar;
    }
    public function update(RequestInterface $request)
    {
        $foo = $request->input("foo");
        $this->co->bar = $foo;
        //coroutine yield
        return $this->co->bar;
    }

    public function getco()
    {
        return $this->bar;
    }

    public function setco(RequestInterface $request)
    {
        $foo = $request->input("foo");
        $this->bar = $foo;
        //coroutine yield
        return $this->bar;
    }

    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return Context::get(__CLASS__.":".$name);
    }

    public function __set(string $name, $value): void
    {
        // TODO: Implement __set() method.
        //存储到协程上下文中
        Context::set(__CLASS__.":".$name,$value);
    }
}