<h2>ユーザーログイン</h2>

<?php echo $form->create('User',array('url'=>'/auths/','type'=>'post'));?>

<?php if(isset($msg)) {
	printf('<div style="color:red;">%s</div>', $msg);
}?> 

<ul class="no-item">
	<li>ログインID<br /><?php echo $form->text('User.login_id',array('class'=>'middle'));?></li>
	<li>パスワード<br /><?php echo $form->text('User.login_pwd',array('class'=>'middle'));?></li>
</ul>
<p style="text-align:center;">
<input type="submit" value="　ログイン　" /><br />
</p>
<?php echo $form->end();?>