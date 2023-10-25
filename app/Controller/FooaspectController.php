<?php
/**
 * 切片
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/14
 * Time: 22:12
 */

namespace App\Controller;

use App\Annotation\Foo;
use Hyperf\HttpServer\Annotation\AutoController;


#[AutoController]
#[Foo(bar:"5")]
class FooaspectController
{
    public function index()
    {
        return 3;
    }
}