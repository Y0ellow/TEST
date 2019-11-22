<?php 
include_once 'public/linkmysql.php';
include_once 'public/tool.inc.php';
$link=connect();
$user_id=is_login($link);
$template['title']='首页';
$template['css']=array('style/backgroud.css','style/student.css');
?>
<?php include 'public/header.inc.php'?>
	<div style="margin-top:30px;"></div>
	<div id="hot" class="auto">
		<div class="title">通知消息</div>
		<ul class="newlist">
<!-- 		<li><a href="#"]</a> 预设为最近发送的一条消息 <a href="#"></a></li> -->
		
	</ul>
		<div style="clear:both;"></div>
	</div>
	<?php 
$query="select * from classroom order by sort desc";
$result_father=run($link, $query);
while($data_father=mysqli_fetch_assoc($result_father)){
?>
<div class="box auto"> <div class="title">	
<a href="list_father.php?id=
 <?php echo $data_father['id']?>
"style="color:#105cb6;">[班级名称]
<?php echo $data_father['class_name']?></a>
</div> <div class="classList"> <div style="padding:10px 0;"></div>
 </div></div>
<div class="box auto"> <div class="classList">
<div class="childBox new">
<h2><a href="">111</a>
 <span>
 </span></h2>
				<br />
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
<?php }?>
<?php include 'public/footer.php'?>