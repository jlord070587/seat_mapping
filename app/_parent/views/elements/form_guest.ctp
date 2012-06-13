<?php echo $this->Form->create('Guest');?> 
<?php
	$u_info = $this->Session->read('UserInfo.User');
	echo $this->Form->hidden('Guest.id',array(
		'value'=>isset($this->data['id']) ? $this->data['id'] : ''))."\n";
	echo $this->Form->hidden('Guest.user_id',array('value'=>$u_info['id']))."\n";
?>
<table class="general" id="formTable">
<tr>
	<th>区分</th>
	<td><?php
		echo $this->Form->error('Guest.whose_guest');
		echo $this->Form->radio('Guest.whose_guest',$whose_map,array('legend'=>false));
	?></td>
</tr>
<tr>
	<th>所属・肩書1</th>
	<td><?php
		echo $this->Form->error('Guest.affiliation1');
		echo $this->Form->text('Guest.affliation1');
	?></td>
</tr>
<tr>
	<th>所属・肩書2</th>
	<td><?php
		echo $this->Form->error('Guest.affiliation2');
		echo $this->Form->text('Guest.affliation2');
	?></td>
</tr>
<tr>
	<th>氏名</th>
	<td><?php
		echo $this->Form->error('Guest.name_sei');
		echo $this->Form->error('Guest.name_mei');
		echo '姓';
		echo $this->Form->text('Guest.name_sei',array('class'=>'x-small'));
		echo '名';
		echo $this->Form->text('Guest.name_mei',array('class'=>'x-small'));
	?></td>
</tr>
<tr>
	<th>敬称</th>
	<td><?php
		echo $this->Form->error('Guest.proper_title');
		echo $this->Form->radio('Guest.proper_title',
			array_combine($proper_map,$proper_map),
			array('legend'=>false)
		);
	?></td>
</tr>
</table>
<p style="text-align:center;"><?php echo $this->Form->submit('　登録　',array('div'=>false))."\n";?></p>
<?php echo $this->Form->end();?> 