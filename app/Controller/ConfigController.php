<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/20
 * Time: 21:28
 */

namespace App\Controller;
use Hyperf\Config\Annotation\Value;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
class ConfigController
{

    //依赖注入配置文件
    #[Inject(ConfigInterface::class)]
    private $config;

    #[Value("foo.bar")]
    private $bar;

    //第一种读取配置文方法
    public function inject()
    {
        return $this->config->get('foo.bar',123);
    }

    //第二种读取配置文方法
    public function value()
    {
        return $this->bar;
    }

    //第三种读取配置文方法
    public function config()
    {
        return config('foo.bar',123);
    }

}