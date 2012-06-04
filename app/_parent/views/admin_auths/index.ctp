<h2>管理者ログイン</h2>

<?php echo $form->create('AdminAuth',array('action'=>'index','type'=>'post'));?>
<fieldset>
<legend>IDとパスワードを入力してください</legend>

<?php if(isset($msg)):?><p class="error-message"><?php e($msg);?></p><?php endif;?>

<ul style="display:inline;" class="inline">
	<li>ID：<?php echo $form->text('AdminAuth.id',array('class'=>'small'));?></li>
	<li>PW：<?php echo $form->password('AdminAuth.password',array('class'=>'small'));?></li>
</ul>
<?php echo $form->submit('LOGIN',array('id'=>'submitBtn','div'=>false));?>
</fieldset>
<?php echo $form->end();?>