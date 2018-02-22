<?php
session_start();
header('Content-type:text/html;charset=utf-8');
date_default_timezone_set ('Asia/Shanghai');
include '../conn.php';
$albumname=$_POST['zjname'];
$sql=mysqli_query($link,"select * from tb_album where albumname='$albumname'");
$sql2=mysqli_query($link,"select * from tb_music where zhuanji='$albumname'");
$result2=mysqli_fetch_object($sql2);
$result=mysqli_fetch_object($sql);
?>

<div class="col-md-4"  style="margin-top: 10px;">
	<img src="./image/<?php echo $result->picway;?>" class="img-responsive">
</div>
<div class="col-md-8" style="margin-top: 10px;">
	<h3>
		<?php echo $result->albumname;?>
	</h3>
	<p style="text-indent: 30px;">
		<?php echo $result->intro;?>
	</p>
	<h5>
		歌手：<?php echo $result->singername;?>
		<small>
			<?php echo $result->createtime;?>
		</small>
	</h5>
	<button class="btn btn-success" onclick="javascript:window.location.href='index.php'">返回首页</button>
</div>



	<div class="col-md-12 table-responsive">
		<h3 class="text-center">歌曲列表</h3>
        <ul>

          <li>
            <table class="table table-striped text-center">
              <tr>
                <td style="border-right: 2px solid #333;">&nbsp;&nbsp;</td>
                <td style="border-right: 2px solid #333;">收藏</td>
                <td style="border-right: 2px solid #333;">音乐标题</td>
                <td style="border-right: 2px solid #333;">歌手</td>
                <td>专辑</td>
              </tr>

            </li>
           <?php
            
            $sql=mysqli_query($link,"select * from tb_music where zhuanji='$albumname'");
            $result=mysqli_fetch_object($sql);
            $username=$_SESSION['unc'];
            $sql2=mysqli_query($link,"select musicid from tb_collecte inner join tb_user on tb_collecte.userid=tb_user.userid where username='$username'"); 
            $result2=mysqli_fetch_object($sql2);
            $a=[];
            $num=mysqli_num_rows($sql2);
            for($i=0;$i<$num;$i++)
            {
             $a[$i]=$result2->musicid;
             $result2=mysqli_fetch_object($sql2);
           }

           do{
            ?>

            <li>
              <a href="#" style="display: block;">
                <tr onclick="playmusic('<?php echo $result->musicway;?>','<?php echo $result->picway;?>','<?php echo $result->musicname;?>')">
                  <td>
                    <?php echo $result->musicid;?>
                  </td>
                  <td>
                    <a href="./php/check_status.php?musicid=<?php echo $result->musicid;?>" style="color: #333;">
                      <?php 
                      if(in_array($result->musicid, $a))
                        echo "<span class='glyphicon glyphicon-heart' style='color:red;'></span>";
                      else echo "<span class='glyphicon glyphicon-heart'></span>";
                      ?>
                    </a>
                  </td>
                  <td>
                    <?php echo $result->musicname;?>
                  </td>
                  <td>
                    <a href="" onclick="getsinger('<?php echo $result->singer;?>');javascript:return false;"><?php echo $result->singer;?></a>
                    
                  </td>
                  <td>
                  <?php echo $result->zhuanji;?> 
                 </td>
               </tr>
             </a>            
           </li> 
           <?php
         }while($result=mysqli_fetch_object($sql))?>

         	</table> 
        
       
     </ul>


   </div>


      



