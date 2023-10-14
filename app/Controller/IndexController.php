<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/14
 * Time: 17:35
 */

namespace App\Controller;

use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\HttpServer\Annotation\AutoController;

use App\Annotation\Foo;

#[AutoController]
#[Foo("123")]
class IndexController
{
    public function index()
    {
        var_dump(AnnotationCollector::getClassesByAnnotation(Foo::class));
        return 1;
    }
}