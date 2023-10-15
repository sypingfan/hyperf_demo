<?php
/**
 * 协程
 * Created by PhpStorm.
 * User: 平凡
 * Date: 2023/10/15
 * Time: 22:37
 */

namespace App\Controller;

use Hyperf\Coroutine\Parallel;
use Hyperf\Coroutine\WaitGroup;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Swoole\Coroutine\Channel;

#[AutoController]
class Co1Controller
{
    #[Inject(ClientFactory::class)]
    private $clientFactory;

    public function sleep(RequestInterface $request)
    {
        $seconds = $request->query("seconds",1);
        sleep($seconds);
        return $seconds;
    }

    public function test()
    {
        //标识执行顺序
        $channel = new Channel();//1
       \Hyperf\Coroutine\co(function ()use($channel){
           $client  = $this->clientFactory->create();//2
           $client->get("47.106.217.221:9501/co1/sleep?seconds=2");//3
           $channel->push(123);//7
        });
        \Hyperf\Coroutine\co(function ()use($channel){
            $client  = $this->clientFactory->create();//4
            $client->get("47.106.217.221:9501/co1/sleep?seconds=2");//5
            $channel->push(321);//9
        });
        $result[] = $channel->pop();//6
        $result[] = $channel->pop();//8
        return $result;
    }

    /**
     * 使用WaitGroup来执行
     * @return array
     */
    public function test1()
    {
        $wg = new WaitGroup();
        $result = [];
        $wg->add(2);//计数器加二
        \Hyperf\Coroutine\co(function ()use($wg,&$result){
            $client  = $this->clientFactory->create();
            $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
            $result[] = 123;
            $wg->done();//执行完毕 计数器减一
        });
        \Hyperf\Coroutine\co(function ()use($wg,&$result){
            $client  = $this->clientFactory->create();
            $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
            $result[] = 321;
            $wg->done();//执行完毕 计数器减一
        });
        $wg->wait();//等待子协程执行完毕执行主协程
        return $result;
    }

    /**
     * 使用Parallel来执行
     * @return array
     */
    public function test2()
    {
        //全局函数,跟简洁的实现
        $result = parallel([
            function (){
                $client  = $this->clientFactory->create();
                $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
                return 123;
            },
            function (){
                $client  = $this->clientFactory->create();
                $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
                return 321;
            }
        ]);
        /*$parallel = new Parallel();
        $parallel->add(function (){
            $client  = $this->clientFactory->create();
            $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
            return 123;
        },"foo");
        $parallel->add(function (){
            $client  = $this->clientFactory->create();
            $client->get("47.106.217.221:9501/co1/sleep?seconds=2");
            return 321;
        },"bar");
        $result =  $parallel->wait();*/
        return $result;
    }
}