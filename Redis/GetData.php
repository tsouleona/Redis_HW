<?php
require_once 'MysqlConnect.php';

    class GetData
    {
        public function getP ()
        {
            /**
             * 接收存取網頁的cookie
             */
            $ch = curl_init();
            $url = "http://www.228365365.com/sports.php";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
            curl_exec($ch);
            curl_close($ch);

            /**
             * 送出網頁的cookie資訊
             */
            $ch = curl_init();
            $url = "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
            $data = curl_exec($ch);
            curl_close($ch);

            /**
             * 將陣列取代為$testA
             * 將 new Array 取代為 array
             * 將不要的資訊刪除(取代為空)
             */
            $data = str_replace("parent.t_page", '$page_total', $data);

            /**
             * 將function 以下的刪除
             */
            $location = strpos($data, '$page_total');
            $data = substr($data, $location);

            /**
             * 將陣列開始的資料留下
             */
            $location = strpos($data, 'parent.gamount');
            $data = substr($data, 0, $location);

            /**
             * 接 <?php 為php檔案
             */
            $data = '<?php '.$data;

            /**
             * 將處理好的內容寫入資料夾
             */
            $file = fopen("PageTotal.php", "w+");
            fwrite($file, $data);
            fclose($file);
        }

        public function getData ()
        {
            require_once 'PageTotal.php';
            $page = 0;
            while($page < $page_total)
            {
                /**
                 * 接收存取網頁的cookie
                 */
                $ch = curl_init();
                $url = "http://www.228365365.com/sports.php";
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
                curl_exec($ch);
                curl_close($ch);

                /**
                 * 送出網頁的cookie資訊
                 */
                $ch = curl_init();
                $url = "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=".$page."&league_id=&hot_game=";
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
                $data = curl_exec($ch);
                curl_close($ch);

                /**
                 * 將陣列取代為$testA
                 * 將 new Array 取代為 array
                 * 將不要的資訊刪除(取代為空)
                 */
                $data = str_replace("parent.gamount", '$count', $data);
                $data = str_replace("parent.GameFT", '$testA', $data);
                $data = str_replace("Running Ball", "", $data);
                $data = str_replace("a<br>", "a", $data);
                $data = str_replace("p<br>", "p", $data);
                $data = str_replace("<br>", " ", $data);
                $data = str_replace("new Array", "array", $data);
                $data = str_replace("<font color=red>", "", $data);
                $data = str_replace("</font>", "", $data);

                /**
                 * 將function 以下的刪除
                 */
                $location = strpos($data, "function");
                $data = substr($data, 0, $location);

                /**
                 * 將陣列開始的資料留下
                 */
                $location = strpos($data, '$count');
                $data = substr($data, $location);

                /**
                 * 接 <?php 為php檔案
                 */
                $data = '<?php '.$data;

                /**
                 * 將處理好的內容寫入資料夾
                 */
                $file = fopen("newdata.php", "w+");
                fwrite($file, $data);
                fclose($file);
                $this->insertEntry();
                $page++;
            }

        }

        public function insertEntry()
        {
            /**
             * require newdata 取用 $testA的陣列內容，並存入資料庫
             */
            require 'newdata.php';
            if($count != 0)
            {
                $x = count($testA);
                $connect = new Connect();

                /**
                 *將O和U 換成 大和小
                 */
                for($i = 0 ; $i < $x ; $i++)
                {
                    $testA[$i][11] = substr($testA[$i][11], 1);
                    $testA[$i][12] = substr($testA[$i][12], 1);
                    $testA[$i][27] = substr($testA[$i][27], 1);
                    $testA[$i][28] = substr($testA[$i][28], 1);
                }

                for($i = 0 ; $i < $x ; $i++)
                {
                    $sql = "INSERT INTO `entry`(`competition_id`, `datetime`, `competition`, `teamone`, `teamtwo`, `wholeconcede`,
                    `wholepoint`, `teamone_whole_concede_point`, `teamtwo_whole_concede_point`, `teamone_whole_bigsmall_point`,
                    `teamtwo_whole_bigsmall_point`, `teamtwo_whole_bigsmall_point_back`, `teamone_whole_bigsmall_point_back`,
                    `teamone_win_whole_point`, `teamtwo_win_whole_point`, `peace_whole_point`, `single`, `even`, `single_point`,
                    `even_point`, `halfconcede`, `halfpoint`, `teamone_half_concede_point`, `teamtwo_half_concede_point`,
                    `teamone_half_bigsmall_point`, `teamtwo_half_bigsmall_point`, `teamtwo_half_bigsmall_point_back`,
                    `teamone_half_bigsmall_point_back`, `teamone_win_half_point`, `teamtwo_win_half_point`, `peace_half_point`)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $params = [$testA[$i][0],$testA[$i][1],$testA[$i][2],$testA[$i][5],$testA[$i][6],$testA[$i][7],
                    $testA[$i][8],$testA[$i][9],$testA[$i][10],$testA[$i][11],$testA[$i][12],$testA[$i][13],$testA[$i][14],
                    $testA[$i][15],$testA[$i][16],$testA[$i][17],$testA[$i][18],$testA[$i][19],$testA[$i][20],$testA[$i][21],
                    $testA[$i][23],$testA[$i][24],$testA[$i][25],$testA[$i][26],$testA[$i][27],$testA[$i][28],$testA[$i][29],
                    $testA[$i][30],$testA[$i][31],$testA[$i][32],$testA[$i][33]];
                    $connect->executeSql($sql, $params);
                }
                $connect->pdo_connect = null;
            }
        }
    }