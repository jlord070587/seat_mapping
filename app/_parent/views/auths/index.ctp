<h2>ユーザーログイン</h2>

<div id="authBox">
<?php echo $form->create('User',array('url'=>'/auths/','type'=>'post'));?>

<?php if(isset($msg)) {
	printf('<div class="error-message">%s</div>', $msg);
}?> 

<ul>
	<li>ログインID <?php echo $form->text('User.login_id');?></li>
	<li>パスワード <?php echo $form->text('User.login_pwd');?></li>
</ul>
<p style="text-align:center;">
<input type="submit" value="　ログイン　" /><br />
</p>
<?php echo $form->end();?>
</div>