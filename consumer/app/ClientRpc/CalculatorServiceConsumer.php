<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/26
 * Time: 22:56
 */

namespace App\ClientRpc;

use Hyperf\RpcClient\AbstractServiceClient;

class CalculatorServiceConsumer extends AbstractServiceClient implements CalculatorServiceInterface
{

    /**
     * 定义对应服务提供者的服务名称
     */
    protected string $serviceName = 'CalculatorService';

    /**
     * 定义对应服务提供者的服务协议
     */
    protected  string $protocol = 'jsonrpc-http';
    public function add(int $a, int $b): int
    {
        // TODO: Implement add() method.
        return $this->__request(__FUNCTION__, compact('a', 'b'));
    }

    public function minus(int $a, int $b): int
    {
        // TODO: Implement minus() method.
        return $this->__request(__FUNCTION__, compact('a', 'b'));

    }
}