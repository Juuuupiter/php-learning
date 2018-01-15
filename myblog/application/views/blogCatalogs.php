<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>博客设置/分类管理 Johnny的博客 - SYSIT个人博客</title>
	<base href="<?php echo site_url(); ?>">
	<link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <script type="text/javascript" src="assets/js/jquery-1.11.2.js"></script>
<!--  <script type="text/javascript" src="assets/js/jquery.js"></script>-->
  <script type="text/javascript" src="assets/js/jquery_002.js"></script>
  <script type="text/javascript" src="assets/js/oschina.js"></script>
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
<div id="OSC_Banner">
    <div id="OSC_Slogon">
		<?php
		$user = $this->session->userdata('user');
		if(isset($user)){
			echo $user->username."'s blog";
		}
		?>
	</div>
    <div id="OSC_Channels">
        <ul>
        <li><a href="#" class="project">
				<?php
				$user = $this->session->userdata('user');
				if(isset($user)){
					echo $user->mood;
				}
				?>
			</a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div><!-- #EndLibraryItem --><div id="OSC_Topbar">
	  <div id="VisitorInfo">
		当前访客身份：
		  <?php
		  //		  $user = $this->session->userdata('user');
		  echo $user->username;
		  ?>[ <a href="#">退出</a> ]
				<span id="OSC_Notification">
			<a href="#" class="msgbox" title="进入我的留言箱">你有<em>0</em>新留言</a>
																				</span>
    </div>
		<div id="SearchBar">
    		<form action="#">
								<input name="user" value="154693" type="hidden">
																								<input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" onblur="(this.value=='')?this.value='在此空间的博客中搜索':this.value" onfocus="if(this.value=='在此空间的博客中搜索'){this.value='';};this.select();" type="text">
				<input class="SUBMIT" value="搜索" type="submit">
    		</form>
		</div>
		<div class="clear"></div>
	</div>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="welcome/index_login">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle"d>博客设置/分类管理</span>
    </div>
    <div id="AdminMenu"><ul>
	<li class="caption">个人信息管理		
		<ol>
			<li><a href="inbox.htm">站内留言(0/1)</a></li>
			<li><a href="profile.htm">编辑个人资料</a></li>
			<li><a href="chpwd.htm">修改登录密码</a></li>
			<li><a href="userSettings.htm">网页个性设置</a></li>
		</ol>
	</li>		
</ul>
<ul>
	<li class="caption">博客管理	
		<ol>
			<li><a href="newBlog.htm">发表博客</a></li>
			<li class="current"><a href="blogCatalogs.htm">博客设置/分类管理</a></li>
			<li><a href="blogs.htm">文章管理</a></li>
			<li><a href="blogComments.htm">博客评论管理</a></li>
		</ol>
	</li>
</ul>
</div>
    <div id="AdminContent">
<div class="MainForm BlogCatalogManage">
<form id="CatalogForm"  onsubmit="return false" method="post">
    <h3> 添加博客分类 </h3>
    <div id="error_msg" class="error_msg" style="display:none;"></div>
    <label>分类名称:</label><input id="txt_link_name" name="name" size="15" tabindex="1" type="text">
    <input type="hidden" id="type_id">
	<label>排序值:</label><input name="sort_order" value="0" size="3" type="text">
    <span class="submit">
          <input id="btn_add" value="添加&nbsp;»" tabindex="3" class="BUTTON SUBMIT" type="submit" >
		  <input id="btn_change" value="修改&nbsp;»" tabindex="3" class="BUTTON SUBMIT" type="submit" style="display: none">
		<input id="btn_no" value="取消&nbsp;»" tabindex="3" class="BUTTON SUBMIT" type="submit"  style="display: none">
        </span>
</form>
<form class="BlogCatalogs">
<h3>博客分类 <span>(点击分类名编辑)</span></h3>
<table cellpadding="1" cellspacing="1">
	<tbody><tr>
		<th>序号</th>
		<th>分类名</th>
		<th>文章</th>
		<th>操作</th>
	</tr>
	<?php foreach($types as $index =>$type){?>
	<tr>
<!--		<input type="hidden">-->
		<td><?php echo $index+1 ?></td>
		<td class="name" typeid="<?php echo $type->type_id ?>"><?php echo $type->type_name?></td>
		<td><?php echo $type->num?></td>
		<td class="opts">
		<a href="javascript:;" class="rename" title="点击修改博客分类">修改</a>
		<a href="javascript:;" class="delete" ">删除</a>
<!--			onclick="return delete_catalog(154693,92334);-->
		</td>
	</tr>
	<?php } ?>
</tbody></table>
</form>
</div>
<script type="text/javascript">
<!--
//$('#CatalogForm').ajaxForm({
//    success: function(html) {
//    	if(html.length == 0)
//    		location.reload();
//    	else{
//    		$('#error_msg').hide();
//    		$('#error_msg').html(html);
//    		$('#error_msg').show("fast");
//        }
//	}
//});
//$('#BlogDispForm').ajaxForm({
//    success: function(html) {alert(html);}
//});
//function delete_catalog(space, catalog_id){
//	if(confirm('确实要删除此博客分类吗？')){
//		var args = "space="+space+"&id="+catalog_id;
//		ajax_post('/action/blog/delete_blog_catalog',args,function(html){
//		if(html.length==0)
//			$('#catalog_'+catalog_id).fadeOut();
//		else
//			alert(html);
//		});
//	}
//	return false;
//}
//$('#chb_blog_enabled').click(function(){
//	var chk = $('#chb_blog_enabled').attr("checked");
//	if(!confirm(chk?"请确认是否要开启空间的博客功能？":"请确认是否要关闭空间博客功能？")) return false;
//	ajax_post("/action/blog/switch_blog?space=154693","enabled="+chk,function(){
//		alert(chk?"已经开启了博客功能！":"博客功能已经关闭！");
//	});
//});
//-->
</script></div>
	<div class="clear"></div>
</div>

</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
<!--<script type="text/javascript" src="js/space.htm" defer="defer"></script>-->
<script type="text/javascript">
<!--
$(function(){
	$('.rename').on('click',function(){
           var text = $(this).parents('tr').find('.name').text();
		   var type_id = $(this).parents('tr').find('.name').attr('typeid');
		   $('#txt_link_name').val(text);
		   $('#type_id').val(type_id);
		   $('#btn_add').hide("fast");
		   $('#btn_change').show("fast");
		   $('#btn_no').show("fast");
	});
	$('#btn_no').on('click',function(){
		$('#btn_add').show("fast");
		$('#btn_change').hide("fast");
		$('#btn_no').hide("fast");
	});

	$('.delete').on('click',function(){
		if(confirm('确实要删除此博客分类吗？')){
			var type_id = $(this).parents('tr').find('.name').attr('typeid');
			$.get('welcome/del_type',{
				type_id:type_id
			},function(data){
				if(data == 'fail'){
					alert('这个分类不是你的!!!');
				}
				if(data == 'success'){
					location.href = 'welcome/blog_catalogs';
				}
			},'text');
		}
	})
	$('#btn_change').on('click',function() {
		var type = $('#txt_link_name').val();
		var type_id = $('#type_id').val();

		$.get('Welcome/change_type', {
			type: type,
			type_id: type_id
		}, function (data) {
			if(data == 'success'){
				location.href = 'welcome/blog_catalogs';
			}
		}, 'text');
		console.log(type,type_id)
	})

		$('#btn_add').on('click',function(){
		var type = $('#txt_link_name').val();
		$.get('User/add_type',{
			type:type
		},function(data){
			if(data == ''){
				$('#error_msg').html("不");
				$('#error_msg').show("fast");
			}else{
				location.href = 'welcome/blog_catalogs';
			}
		},'text')
	})

})
//-->
</script>
</body></html>