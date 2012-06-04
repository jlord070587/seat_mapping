<h2><?php echo $this->Session->read('UserInfo.User.user_name');?>さんのマイページ</h2>

<ul>
	<li><?php echo $this->Html->link('アンケート',array('action'=>'enquete/entry'));?></li>
	<li><?php echo $this->Html->link('披露宴席次表編成',array('action'=>'seat_mapping'));?></li>
	<li><?php echo $this->Html->link('写真ピックアップ',array('action'=>'photo_select'));?></li>
</ul>