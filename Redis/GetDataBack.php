<?php
    require_once 'Delete.php';
    require_once 'GetData.php';
    require_once 'RedisProcess.php';

    ignore_user_abort(true);
    set_time_limit(0);
    do{
        $delete = new DeleteData();
        $delete->deleteAll();
        $getdata = new GetData();
        $getdata->getP();
        $getdata->getData();
        $redis = new RedisProcess();
        $redis->setRedis();
        sleep(60);
    }while(true);
