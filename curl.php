<?php
    $ch = curl_init();
    $url = "http://tt181.me/test0975313025.php";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['token:rd1']);
    curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array( "id"=>"10", "name"=>"Leona")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;