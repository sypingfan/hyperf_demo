<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/14
 * Time: 17:16
 */
namespace App\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class Foo extends AbstractAnnotation
{
    #[PropertyAnnotation]
    public $bar;

    public $baz;

    public function __construct(...$value)
    {
        var_dump($value);
        parent::__construct($value);
        $this->bindMainProperty("bar",$value);
    }
}