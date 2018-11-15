<?php
/**
 * Created by PhpStorm.
 * User: zhouzzz
 * Date: 2018/11/15
 * Time: 11:22
 */

namespace app\push\controller;


use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use think\Env;

class Run
{
    public function __construct()
    {
        \think\Loader::addNamespace([
           'workerman' => Env::get('root_path').'extend/'.'workerman/workerman',
           'GatewayWorker' => Env::get('root_path').'extend/'.'workerman/gateway-worker/src',
        ]);

        //初始化register
        new Register('text://0.0.0.0:1238');

        //初始化bussinessWorker进程
        $worker = new BusinessWorker();
        $worker->name = 'WebmateBussinessWorker';
        $worker->count = 4;//进程数
        $worker->registerAddress = '127.0.0.1:1238';

        $worker->eventHandler = '\app\push\controller\Events';//业务处理的类

        //初始化gateway进程
        $gateway = new Gateway('Websocket://0.0.0.0:8282');
        $gateway->name = 'WebmateGateway';
        $gateway->count = 4;
        $gateway->lanIp = '127.0.0.1';
        $gateway->startPort = '2900';
        $gateway->registerAddress = '127.0.0.1:1238';

        $worker::runAll();




    }


}