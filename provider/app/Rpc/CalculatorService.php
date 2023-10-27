<?php
/**
 * 微服务-计算器服务者
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/25
 * Time: 21:55
 */

namespace App\Rpc;

use Hyperf\RpcServer\Annotation\RpcService;

#[RpcService(name: "CalculatorService",protocol: "jsonrpc-http",server: "jsonrpc-http",publishTo: "consul")]
class CalculatorService implements CalculatorServiceInterface
{
    public function add(int $a,int $b):int
    {
        return $a + $b;
    }

    public function minus(int $a,int $b):int
    {
        return $a - $b;
    }
}