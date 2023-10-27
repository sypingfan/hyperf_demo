<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/25
 * Time: 21:59
 */

namespace App\Rpc;

interface CalculatorServiceInterface
{
    public function add(int $a, int $b): int;

    public function minus(int $a, int $b): int;
}