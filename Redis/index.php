<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Redis</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="jquery/jquery.js"></script>

</head>
<body>
    <?php
        $userId = $data[0];
    ?>
    <input style="visibility:hidden" value="<?php echo $userId;?>" id="userId" />
    <br><br><br>
    <div id="allList"><h3 style="color:#ff5d79"><strong>資料更新中，請稍後將為您服務</strong></h3></div>
    <script>
    $.ajax({
        url:'https://lab1-srt459vn.c9users.io/memcache_HW/Redis/DataList.php',
        success:function(data){
            $("#allList").html(data);
        }
    });
    </script>
    <script>
    $(document).ready(function ()
    {
        var poll = function ()
        {
            $("#allList").html('<h3 style="color:#ff5d79"><strong>資料更新中，請稍後將為您服務</strong></h3>');
            $.ajax({
                url:'https://lab1-srt459vn.c9users.io/memcache_HW/Redis/DataList.php',
                success:function(data){
                    $("#allList").html(data);
                }
            });
        }
        setInterval(poll, 60000);
     });
    </script>
    <!-- Bootstrap Core js -->
    <script src="js/bootstrap.js"></script>
</body>
</html>