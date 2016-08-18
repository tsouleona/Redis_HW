<?php
require_once 'MysqlConnect.php';

    class RedisProcess
    {
        public function setRedis()
        {
            $connect = new Connect();
            $sql = "SELECT * FROM `entry`";
            $params = [];
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $redis->set("game_data", json_encode($row, JSON_UNESCAPED_UNICODE));
        }

        public function getRedis()
        {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $data = $redis->get("game_data");
            return$data;
        }
    }

