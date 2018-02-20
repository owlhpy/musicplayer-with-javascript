<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>菜品管理</title>
	<script type="text/javascript" src="../bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
	<div class="container">

		<div class="row">
			<h2>餐厅菜品营业管理后台</h2>
		</div>
		<div class="row">
            <div class="col-md-2">
                <?php include "./leftbar.php";?>
            </div>
			<div class="col-md-10">
                <table class="table table-bordered">
                <tr>
                    <td>
                        菜名
                    </td>
                    <td>
                        类别
                    </td>
                    <td>
                        折扣
                    </td>
                    <td>
                        规格
                    </td>
                    <td>
                        编辑
                    </td>
                    <td>
                        删除
                    </td>
                </tr>
                <?php
                include './conn.php';
                date_default_timezone_set ('Asia/Shanghai');
if(!isset($_GET["page"])){$page=1;}
if(isset($_GET["page"])){$page=$_GET["page"];}
if(is_numeric($page)){
    $page_size=4;
    $result=mysqli_query($link,"select * from tb_food inner join tb_foodsize on tb_foodsize.id=tb_food.id");
    $message_count=mysqli_num_rows($result);
    $page_count=ceil($message_count/$page_size);
    $offset=($page-1)*$page_size;
    $sqlg=mysqli_query($link,"select * from tb_food inner join tb_foodsize where tb_foodsize.id=tb_food.id limit $offset,$page_size");
    $row=mysqli_fetch_object($sqlg);
}
?>

<?php
  // if(isset($_POST["submit"])){
  //                                       $keyword=$_POST["txt_keyword"];
  //                                       $sql=mysqli_query($link,"select * from ay_yyndy where author like '%".trim($keyword)."%' order by createtime desc");
  //                                       $row=mysqli_fetch_object($sql);

  //                                   }
  //               if(!$row){
  //               echo "没有找到内容";
  //                              }else{

                                        do{
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row->fname;?>
                                                </td>
                                                <td>
                                                    <?php echo $row->fclass;?>
                                                </td>
                                                 <td>
                                                    <?php echo $row->discount;?>
                                               </td>
                                               <td>
                                                   <?php echo $row->size;?>
                                               </td>
                                                <td>
                                                    <a href="./modify_food.php?size=<?php echo $row->size;?>&id=<?php echo $row->id;?>"><b class="glyphicon glyphicon-edit"></b></a>
                                                </td>
                                                <td>
                                                    <a href="./delfood.php?size=<?php echo $row->size;?>&id=<?php echo $row->id;?>"><b class="glyphicon glyphicon-remove"></b></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }while($row=mysqli_fetch_object($sqlg));
                                    
                                    ?>

            </table>
             <ul class="pager">
                    <li class="previous">
                    <?php if($page!=1){
    echo "<a href=control.php?page=1>首页</a>&nbsp;";}?>
                    </li>
                    <li class="previous">
                    <?php if($page!=1){
    echo "<a href=control.php?page=".($page-1).">上一页</a>&nbsp;";
}?>
                    </li>
                    <?php echo "共".$page_count."頁/"."第".$page."頁"?>
                                        <li class="next"><?php
if($page<$page_count){
                    echo "<a href=control.php?page=".$page_count.">尾页</a>&nbsp;";
                    }?>
                    </li>
                    <li class="next">
                    <?php
if($page<$page_count){
echo "<a href=control.php?page=".($page+1).">下一页</a>&nbsp;";
}?>
                    </li>

                </ul>
            </div>
			
		</div>
	</div>
</body>
</html>