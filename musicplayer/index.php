<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DZY2</title>
  <script type="text/javascript" src="./bootstrap-3.3.7-dist/js/jquery.min.js"></script>
  <script type="text/javascript" src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <style type="text/css">
  body{
    display: flex;
    margin: 0;
    background: #eee;
  }
  footer{
    flex: 1;
    margin: auto;
  }
  
  .bar_right{
    width: 100%;
    height: 3px;
    border-radius: 3px;
    background-color: #eee;
    position: relative;

  }
  .progress{
    width: 0;
    height: 3px;
    border-radius: 3px;
    background-color: #00b3d3;
    position: absolute;
    left: 0;
    /*top: -10px;*/
  }
  .pro_dot{
    width: 10px;
    height: 10px;
    border-radius: 5px;
    float: left;
    background-color: #00b3d3;
    position: absolute;
    top: -3px;
    left: 0;
    z-index: 1;
  }
  ul>li{
    cursor: pointer;
    list-style: none;
  }
</style>
</head>
<body>
  <div class="container" style="background: rgba(255,255,255,.5);">
    <!-- 大标题 -->
    <div class="row" style="background: url('./image/login.gif');color: white;">
      <div class="row">
        <div class="col-md-12" style="padding-left: 30px;">
          <h2>
            OWLHPY(黄佩妍)'s
            <small style="color: white;">基于h5和javascript的音乐播放器 </small>
            <span class="pull-right" style="padding-right: 30px;">
              <?php
              echo $_SESSION['unc']."欢迎你";
              ?>
              
            </span>
          </h2>
          

        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-xs-3">

        </div>
        <div class="col-md-6 col-xs-6">
          <div class="form-group has-success has-feedback">
            <label class="control-label" for="inputSuccess2" style="color: white;">搜索歌曲(此功能尚未实现)</label>
            <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            <span id="inputSuccess2Status" class="sr-only">(success)</span>
          </div>
        </div>
        <div class="col-md-3 col-xs-3">
          <a href="" class="btn btn-success" style="margin-top: 26px;" onclick="showcollect();javascript:return false;">我的收藏</a>
          <a href="login.php" class="btn btn-success" style="margin-top: 26px;">退出登录</a>
        </div>   
      </div> 

    </div>
    <!-- 大标题和搜索框结束 -->
    <!-- 音乐列表区域开始 -->
    <div class="row" style="min-height: 60vh;overflow: auto;" id="show">
      <div class="col-md-12 table-responsive" style="margin-top: 10px;">
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
            include 'conn.php';
            
            $sql=mysqli_query($link,"select * from tb_music");
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
                   <a href="" onclick="getalbum('<?php echo $result->zhuanji;?>');javascript:return false;"><?php echo $result->zhuanji;?></a> 
                 </td>
               </tr>
             </a>            
           </li> 
           <?php
         }while($result=mysqli_fetch_object($sql))?> 

       </table> 
     </ul>


   </div>
 </div>


 <!-- 音乐播放区域开始 -->
 <footer>   

  <div class="col-md-12 audiostyle">
    <!-- 音乐图片 -->
    <div class="col-md-2">
      <img src="./image/song1.jpg" class="img-responsive img-circle" style="border:1px solid red;height: 100px;width: 100px;" id="musicpic">
    </div>
    <!-- 播放器暂停、播放图标 -->
    <div class="col-md-1 bar_left col-xs-1" id="control_play">
      <h2><span class="glyphicon glyphicon-play-circle" data-key="10"></span></h2>
    </div>
    <!-- 进度条样式 -->
    <div class="col-md-9 col-xs-11">
      <audio>
       <source src=""  type="audio/mp3">
       </audio>
       <p class="text-center" id="musicname">
         音乐名称
       </p>
       <div class="bar_right" id="bar_right">
        <span class="pro_dot" id="pro_dot"></span>
        <div class="progress" id="progress"></div>
      </div>
      <!-- 播放歌曲时间 -->
      <div style="margin-top: 5px;">
        <span class="pull-left" id="current_time">00:00</span>
        <span class="pull-right" id="whole_time">00:00</span>
      </div>

    </div>
  </div>

</footer>


</div>

<script type="text/javascript">

  var audio=document.getElementsByTagName('audio')[0];
  var xmlObj;
  var current_time=document.getElementById('current_time');//歌曲当前播放时间span
  var whole_time=document.getElementById('whole_time');//歌曲总时间span
  var span = document.querySelector(`span[data-key="10"]`);//播放按钮的span
  var progress=document.getElementById('progress');//获取进度条
  var pro_dot=document.getElementById('pro_dot');//获取进度条的拖动点
  var pro_parent=document.getElementById('bar_right');//获取进度条的父元素
  function playmusic(value,picway,musicname){
    // console.log(value);
    audio.src="./music/"+value+".mp3";
    span.classList.remove("glyphicon-play-circle");
    span.classList.add("glyphicon-pause");
    document.getElementById('musicpic').src="./image/"+picway;
    document.getElementById('musicname').innerHTML=musicname;
    audio.play();
    

    
  }
  function getalbum(zjname){
     // console.log(this.Target.parent.tagName);
      if(window.ActiveXObject)
      {
        xmlObj=new ActiveXObject("Microsoft.XMLHTTP");
      }else if(window.XMLHttpRequest)
      {
        xmlObj=new XMLHttpRequest();
      }
      xmlObj.onreadystatechange=alertContents;
      xmlObj.open("POST","./php/zhuanji.php",true);
      xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
      // 这句很重要
      xmlObj.send("zjname="+zjname);  
  }
  function getsinger(singer){
     // console.log(this.Target.parent.tagName);
      if(window.ActiveXObject)
      {
        xmlObj=new ActiveXObject("Microsoft.XMLHTTP");
      }else if(window.XMLHttpRequest)
      {
        xmlObj=new XMLHttpRequest();
      }
      xmlObj.onreadystatechange=alertContents;
      xmlObj.open("POST","./php/singer.php",true);
      xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
      // 这句很重要
      xmlObj.send("name="+singer);  
  }
  function showcollect(){
     // console.log(this.Target.parent.tagName);
      if(window.ActiveXObject)
      {
        xmlObj=new ActiveXObject("Microsoft.XMLHTTP");
      }else if(window.XMLHttpRequest)
      {
        xmlObj=new XMLHttpRequest();
      }
      xmlObj.onreadystatechange=alertContents;
      xmlObj.open("POST","./php/collect.php",true);
      xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
      // 这句很重要
      xmlObj.send();  
  }
  function alertContents() {
      if(xmlObj.readyState==4&&xmlObj.status==200)
      {
            document.getElementById('show').innerHTML=xmlObj.responseText;
            return false;
      }
    }


  // 播放样式
  pro_parent.onclick=function(e){
    if(!audio.paused||audio.currentTime!=0)
    {
      var pgswidth=pro_parent.offsetWidth;
      var rate=e.offsetX/pgswidth;
      audio.currentTime=audio.duration*rate;
      updateProgress(audio);
    }
  }
  
  audio.addEventListener('ended',function(){
    audioEnded();
  }, false);
  audio.addEventListener('timeupdate', function () {
    updateProgress(audio);
  }, false);

  document.getElementById('control_play').onclick=function(){

    if(audio.paused){
     audio.play();
     span.classList.remove("glyphicon-play-circle");
     span.classList.add("glyphicon-pause");
   }else{
    audio.pause();
    span.classList.remove("glyphicon-pause");
    span.classList.add("glyphicon-play-circle");
  }


  console.log('ok');
}
function audioEnded(){
  progress.style.width = 0;
  pro_dot.style.left = 0;
  span.classList.remove("glyphicon-pause");
  span.classList.add("glyphicon-play-circle");
  current_time.innerHTML="00:00";
  whole_time.innerHTML="00:00";
}
function formatTime(value){
  var time="";
  var s=value.split(':');
  var i=0;
  for(;i<s.length-1;i++)
  {
    time += s[i].length == 1 ? ("0" + s[i]) : s[i];
    time += ":";
  }
  time += s[i].length == 1 ? ("0" + s[i]) : s[i];
  return time;
}
function transTime(value){
  var time="";
  var h=parseInt(value/3600);
  value%=3600;
  var m=parseInt(value/60);
  var s=parseInt(value%60);
  if(h>0)
  {
    time=formatTime(h+':'+m+':'+s);

  }else{
    time=formatTime(m+':'+s);
  }
  return time;
}
function updateProgress(audio){
  var value=audio.currentTime/audio.duration;
  progress.style.width = value*100+'%';
  pro_dot.style.left = value*100+'%';
  current_time.innerHTML=transTime(audio.currentTime);
  whole_time.innerHTML=transTime(audio.duration);
}
</script>
</body>
</html>