<?php 
include_once 'public/linkmysql.php';
include_once 'public/tool.inc.php';
include_once 'public/page.inc.php';
$link=connect();
$member_id=is_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'error', '帖子id参数不合法!');}
$query="select kc.id cid,kc.title,kc.content,kc.time,kc.user_id,kc.times,km.name 
from kk_content kc,user km where kc.id={$_GET['id']} and user_id=km.id";
$result_content=run($link,$query);
if(mysqli_num_rows($result_content)!=1){
	skip('index.php', 'error', '本帖子不存在!');}
	?>   <?php
$query="update kk_content set times=times+1 where id={$_GET['id']}";
run($link,$query);
$data_content=mysqli_fetch_assoc($result_content);
$data_content['times']=$data_content['times']+1;
$data_content['title']=htmlspecialchars($data_content['title']);
$data_content['content']=nl2br(htmlspecialchars($data_content['content']));
$query="select * from news where id={$data_content['user_id']}";
$result_son=run($link,$query);
$data_son=mysqli_fetch_assoc($result_son);


$query="select * from classroom where id={$data_son['classroom_id']}";
$result_father=run($link,$query);
$data_father=mysqli_fetch_assoc($result_father);

$query="select count(*) from kk_reply where content_id={$_GET['id']}";
$count_reply=num($link, $query);

$template['title']=$data_content['title'];
$template['css']=array('style/public.css','style/show.css');
?>
<?php include 'public/header.inc.php'?>
<div id="position" class="auto">
	 <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['class_name']?></a> &gt;
	   &gt;
	  <?php echo $data_content['title']?>
</div>

<div id="main" class="auto">
	<div class="wrap1">
		<div class="pages">
			<?php 
			$query="select count(*) from kk_reply where content_id={$_GET['id']}";
			$count_reply=num($link, $query);
			$page_size=10;
			$page=page($count_reply,$page_size);
			echo $page['html'];
			?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php 
	if($_GET['page']==1){
	?>
	<div class="wrapContent">
		<div class="left">
			<div class="face">
			</div>
			<div class="name">
				<a href=""> <?php echo '收到'?></a>
			</div>
		</div>
		<div class="right">
			<div class="title">
				<h2><?php echo $data_content['title']?></h2>
				<span>阅读：<?php echo $data_content['times']?></span>
				<div style="clear:both;"></div>
			</div>
			</div>
		
			<div class="pubdate">
			    <span> 发布人：  <?php  echo $data_content['name']?></span><br>
				<span class="date">发布于：<?php echo $data_content['time']?> </span>
				<span class="floor" style="color:black;font-size:20px;font-weight:bold;">
				

				</span>
			</div>
			<div class="content">
					 <?php echo $data_content['content']?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php }?>
<?php include 'public/footer.php'?>