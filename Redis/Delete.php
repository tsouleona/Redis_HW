<?php
require_once 'MysqlConnect.php';

    class DeleteData
    {
        public function deleteAll()
        {
            $connect = new Connect();
            $sql= "DELETE FROM `entry` WHERE 1";
            $connect->executeSql($sql, $params);
            $connect->pdo_connect = null;
        }
    }