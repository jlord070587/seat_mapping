<?php if($is_logon):?> 
<ul id="globalNavi" class="clearfix">
	<li><?php echo $this->Html->link('アンケート',
		array('controller'=>'mypages','action'=>'enquete'));?></li>
	<li><?php echo $this->Html->link('披露宴席次表編成',
		array('controller'=>'mypages','action'=>'seat_mapping'));?></li>
	<li><?php echo $this->Html->link('写真ピックアップ',
		array('controller'=>'mypages','action'=>'photo_select'));?></li>
	<li><?php echo $this->Html->link('ログアウト',
		array('controller'=>'auths','action'=>'logout'));?></li>
</ul>
<?php endif;?> 