<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 * 消费者
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\ClientRpc\CalculatorServiceInterface;
use Hyperf\Di\Annotation\Inject;

class IndexController extends AbstractController
{

    #[Inject]
    private CalculatorServiceInterface $calculatorService;
    public function index()
    {
//        return 1;
        return $this->calculatorService->add(1,2);
    }
}
