<?php
    class Connect{
        public $result;
        public $pdo_connect;

        public function connectSql ()
        {
            $db_server = "localhost";
            $db_name = "football";
            $db_user = "tsouleona";
            $db_passwd = "830606";
            $db_connect = "mysql:host=".$db_server.";dbname=".$db_name;
            $this->pdo_connect = new PDO($db_connect, $db_user, $db_passwd);
            $this->pdo_connect->exec("SET NAMES utf8");
        }

        public function executeSql ($sql, $params)
        {
            $this->connectSql();
            $this->result = $this->pdo_connect->prepare($sql);
            $this->result->execute($params);
        }

        public function fetchData ($sql, $params)
        {
            $this->connectSql();
            $this->executeSql($sql, $params);
            $row = $this->result->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }
    }