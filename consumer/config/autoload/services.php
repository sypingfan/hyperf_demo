<?php
/**
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/25
 * Time: 22:14
 */

return [
    'consumers'=>[
        [
            'name'=>'CalculatorService',
        'service'=>\App\ClientRpc\CalculatorServiceInterface::class,
        // 对应容器对象 ID，可选，默认值等于 service 配置的值，用来定义依赖注入的 key
//        'id' =>\App\ClientRpc\CalculatorServiceInterface::class,
         'registry'=>[
             'protocol'=>'consul',
             'address'=>'http://172.17.0.8:8500',
         ],
         'nodes'=>[
             ['host'=>'172.17.0.7','port'=>9502]
         ]
        ]


    ]
];