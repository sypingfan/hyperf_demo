<?php
namespace App\Aspect;
use App\Annotation\Foo;
use App\Controller\FooaspectController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/14
 * Time: 21:36
 */
#[Aspect]
class FooAspect extends AbstractAspect
{
    //要切入的类，可以多个，亦可通过::标识到具体的某个方法，通过*可以模糊匹配
    public array $classes = [
//        FooClass::class,
//        "App\Service\SomeClass::someMethod",
//        "App\Service\SomeClass::*Method",
//        FooaspectController::class."::"."index",

    ];

    // 要切入的注解，具体切入的还是使用了这些注解的类，仅可切入类注解类方法注解
    public array $annotations = [
        Foo::class,
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        // TODO: Implement process() method.
        var_dump(__CLASS__);
        // 切面切入后，执行对应的方法会由此来负责
        // $proceedingJoinPoint 为连接点，通过该类 process() 方法调用原方法并获得结果
        // 在调用前进行某些处理
        $result = $proceedingJoinPoint->process();

        $foo = $proceedingJoinPoint->getAnnotationMetadata()->class[Foo::class];
        $bar = $foo->bar;
        // 在调用后进行某些处理
        return $result+$bar;

    }

}