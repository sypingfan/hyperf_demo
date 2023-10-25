<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 * 全局中间件
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'http' => [
        \App\Middleware\FooMiddleware::class
    ],
];
