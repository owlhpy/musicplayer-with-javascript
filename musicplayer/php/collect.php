<?php
session_start();
header('Content-type:text/html;charset=utf-8');
date_default_timezone_set ('Asia/Shanghai');
include '../conn.php';
 $username=$_SESSION['unc'];
 $sql=mysqli_query($link,"select * from tb_music");
 $result=mysqli_fetch_object($sql);
 $sql1=mysqli_query($link,"select musicid from tb_collecte inner join tb_user on tb_collecte.userid=tb_user.userid where username='$username'"); 
 $result1=mysqli_fetch_object($sql1);
 $a=[];
            $num=mysqli_num_rows($sql1);
            for($i=0;$i<$num;$i++)
            {
             $a[$i]=$result1->musicid;
             $result1=mysqli_fetch_object($sql1);
           }
?>
<div class="col-md-12 table-responsive">
		<h3 class="text-center">我的收藏<span class="glyphicon glyphicon-heart" style="color: red;"></span>
      
		</h3>
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
            if(!$sql1){
              echo "暂无收藏";
            }else{


            
           do{
           	
if(in_array($result->musicid, $a)){

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
                  <a href="" onclick="getalbum('<?php echo $result->zhuanji;?>');javascript:return false;"><?php echo $result->zhuanji;?></a>  
                 </td>
               </tr>
             </a>            
           </li> 
           <?php
       }
         }while($result=mysqli_fetch_object($sql));}?>

         	</table> 
        <li class="text-center">
	<button class="btn btn-success" onclick="javascript:window.location.href='index.php'">返回首页</button>
</li>
       
     </ul>


   		  
   </div>

 
   
