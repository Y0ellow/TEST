<?php
include_once 'public/linkmysql.php';
include_once 'public/tool.inc.php';
$link=connect();
if(isset($_POST['submit']))
{
	$_POST=escape($link,$_POST);
	$query="insert into kk_content(title,content,time,user_id) 
	values('{$_POST['title']}','{$_POST['content']}',now(),user_id)";
	run($link, $query);
	if(mysqli_affected_rows($link)==1){
		skip('publish.php', 'ok', '发布成功！');}
		else{
		skip('publish.php', 'error', '发布失败，请重试！');}
}
$template['title']='帖子发布页';
$template['css']=array('style/public.css','style/publish.css');
?>
<?php include 'public/header.inc.php'?>
	<div id="position" class="auto">
		 <a href="index.php">首页</a> &gt; 发布帖子
	</div>
	<div id="publish">
		<form method="post">
			<select>
				<option value='-1'>请选择一个班级</option>
				<?php 
				$where='';
				if(isset($_GET['classroom_id']) && is_numeric($_GET['classroom_id'])){
					$where="where id={$_GET['classroom_id']} ";
				}
				$query="select * from classroom {$where}order by sort desc";
				$result_father=run($link, $query);
				while ($data_father=mysqli_fetch_assoc($result_father)){
					echo "<optgroup label='{$data_father['class_name']}'>";
					$query="select * from news where classroom_id={$data_father['id']} order by sort desc";
					//查询该班级的news表
					$result_son=run($link, $query);
					while ($data_son=mysqli_fetch_assoc($result_son)){
						if(isset($_GET['news_id']) && $_GET['news_id']==$data_son['id']){
							echo "<option selected='selected' value='{$data_son['id']}'>{$data_son['class_name']}</option>";
						}else{
							echo "<option value='{$data_son['id']}'>{$data_son['class_name']}</option>";
						}
					}
					echo "</optgroup>";
				}
				?>
			</select>
			<input class="title" placeholder="请输入标题" name="title" type="text" />
			<textarea name="content" class="content"></textarea>
			<input class="publish" type="submit" name="submit" value="" />
			<div style="clear:both;"></div>
		</form>
	</div>
<?php include 'public/footer.php'?>