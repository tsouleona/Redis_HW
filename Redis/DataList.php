<?php
require_once 'Delete.php';
require_once 'GetData.php';
require_once 'RedisProcess.php';


    $delete = new DeleteData();
    $delete->deleteAll();
    $getdata = new GetData();
    $getdata->getP();
    $getdata->getData();
    $redis = new RedisProcess();
    $redis->setRedis();
    $data = $redis->getRedis();
    $ans = json_decode($data, true);
?>
<h4><strong><font color="#38c0df">上半部為JSON下半部為畫好的表格</font></strong></h4><br>
<h4><strong><font color="#38c0df">共<?php echo $x = count($ans);?>筆資料</font></strong></h4>
<hr>
<?php echo $data;?>
<hr>
<div class="row" align="center">
    <div class="container">
        <?php if ($ans == null) {?>
            <h4><strong><font color="#38c0df">查無資料</font></strong></h4>
        <?php }?>
        <?php if ($ans != null) {?>
            <table class="table table-hover">
                <thead>
                    <td align="center">
                       <h4><strong><font color="#38c0df">序號</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">時間</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">賽事</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">獨贏</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">全場-讓球</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">全場-大小</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">單雙</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">獨贏</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">半場-讓球</font></strong></h4>
                    </td>
                    <td align="center">
                       <h4><strong><font color="#38c0df">半場-大小</font></strong></h4>
                    </td>
                </thead>
                    <?php
                        $x = count($ans);
                        $number = 1;
                        for($i = 0 ; $i < $x ; $i++)
                        {
                    ?>
                            <tr>
                                <td align="center">
                                   <h5><?php echo $number;?></h5>
                                </td>
                                <td align="center">
                                   <h5><?php echo $ans[$i]['datetime'];?>m</h5>
                                </td>
                                <td align="center">
                                    <h5><?php echo $ans[$i]['competition'];?></h5>
                                    <h5><?php echo $ans[$i]['teamone'];?></h5>
                                    <h5><?php echo $ans[$i]['teamtwo'];?></h5>
                                    <h5>和局</h5>

                                </td>
                                <td align="center">
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['teamone_win_whole_point'];?></h5>
                                    <h5><?php echo $ans[$i]['teamtwo_win_whole_point'];?></h5>
                                    <h5><?php echo $ans[$i]['peace_whole_point'];?></h5>
                                </td>
                                <td align="center">
                                    <?php if ($ans[$i]['wholeconcede'] == 'C') {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['teamone_whole_concede_point'];?></h5>
                                    <h5><?php echo $ans[$i]['wholepoint'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamtwo_whole_concede_point'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                    <?php if ($ans[$i]['wholeconcede'] == 'H') {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['wholepoint'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamone_whole_concede_point'];?></h5>
                                    <h5><?php echo $ans[$i]['teamtwo_whole_concede_point'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <?php if ($ans[$i]['teamone_whole_bigsmall_point'] != null) {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5>大<?php echo $ans[$i]['teamone_whole_bigsmall_point'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamone_whole_bigsmall_point_back'];?></h5>
                                    <h5>小<?php echo $ans[$i]['teamtwo_whole_bigsmall_point'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamtwo_whole_bigsmall_point_back'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['single'];?></h5>
                                    <h5><?php echo $ans[$i]['even'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                </td>
                                <td align="center">
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['teamone_win_half_point'];?></h5>
                                    <h5><?php echo $ans[$i]['teamtwo_win_half_point'];?></h5>
                                    <h5><?php echo $ans[$i]['peace_half_point'];?></h5>
                                </td>
                                <td align="center">
                                    <?php if ($ans[$i]['halfconcede'] == 'C') {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['teamone_half_concede_point'];?></h5>
                                    <h5><?php echo $ans[$i]['halfpoint'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamtwo_half_concede_point'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                    <?php if ($ans[$i]['halfconcede'] == 'H') {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5><?php echo $ans[$i]['halfpoint'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamone_half_concede_point'];?></h5>
                                    <h5><?php echo $ans[$i]['teamtwo_half_concede_point'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <?php if ($ans[$i]['teamone_half_bigsmall_point'] != null) {?>
                                    <h5 style="visibility:hidden">/</h5>
                                    <h5>大<?php echo $ans[$i]['teamone_half_bigsmall_point'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamone_half_bigsmall_point_back'];?></h5>
                                    <h5>小<?php echo $ans[$i]['teamtwo_half_bigsmall_point'];?>&nbsp;&nbsp;<?php echo $ans[$i]['teamtwo_half_bigsmall_point_back'];?></h5>
                                    <h5 style="visibility:hidden">/</h5>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php $number++;?>
                    <?php }?>
            </table>
        <?php }?>
    </div>
</div>
