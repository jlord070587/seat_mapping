<h2><?php echo $this->Session->read('UserInfo.User.user_name');?>さんのマイページ</h2>
<?php
	$template_type = $this->Session->read('UserInfo.User.template_type');
	$template_position = Configure::read(sprintf('template.position.%s',$template_type));
	echo $this->Html->css('seat_mapping')."\n";
	echo $this->element('batch_consoles')."\n";
?> 
<style type="text/css"><!--
#floorArea {
	width:<?php echo $template_position['floor_area_width'];?>px;
	height:<?php echo $template_position['floor_area_height'];?>px;
}
div.groupUnit {
	width:<?php echo GROUP_UNIT_WIDTH;?>px;
	height:<?php echo GROUP_UNIT_HEIGHT;?>px;
}
--></style>

<h3>披露宴席次表編成</h3>

<div id="console">
<p>テンプレート:<?php
	echo $this->Form->select('template',
		Configure::read('template.name'),
		$template_type = $this->Session->read('UserInfo.User.template_type'),
		array('empty'=>'--選択してください--')
	)."\n";
?>　<?php
	echo $this->Form->button(
		$this->Html->image('ico_link_break.png').' 紐付リセット',
		array('type'=>'button','id'=>'resetRelation'))."\n";
?>　<?php if($template_type=='x'){
	echo $this->Form->button(
		$this->Html->image('ico_add_group.png').' テーブルを追加',
		array('type'=>'button','id'=>'addGroup'))."\n";
}?></p>
</div>

<div id="guestListArea">
<p id="layoutThumbWrap"><?php
	if(!$template_type) $template_type = 'x';
	echo $this->Html->image('layout_thumb-'.$template_type.'.png',array('id'=>'layoutThumb'));
?></p>
<div id="guestList">
<ul>
<?php foreach($guest_list as $g_info){
	$attr_title = sprintf('%s　%s %s　%s %s　%s',
		$whose_map[$g_info['Guest']['whose_guest']],
		$g_info['Guest']['affiliation1'],
		$g_info['Guest']['affiliation2'],
		$g_info['Guest']['name_sei'],
		$g_info['Guest']['name_mei'],
		$g_info['Guest']['proper_title']
	);
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s" title="%s">' .
			'<p class="withAttr"><span class="whose">%s</span> ' .
			'<span class="affiliation">%s%s</span></p>' .
			'<p class="belongTo%s">%s %s %s</p></li>'."\n",
		$g_info['Guest']['id'],
		$g_info['Guest']['user_id'],
		'',
		$g_info['Guest']['whose_guest'],
		$attr_title,
		$whose_map[$g_info['Guest']['whose_guest']],
		$g_info['Guest']['affiliation1'],
		$g_info['Guest']['affiliation2'],
		$g_info['Guest']['whose_guest'],
		$g_info['Guest']['name_sei'],
		$g_info['Guest']['name_mei'],
		$g_info['Guest']['proper_title']
	);
}?> 
</ul>
</div>
</div>

<div id="floorAreaWrap">
<?php if($template_type):?> 
<div id="floorArea">
<?php if($group_list):foreach($group_list as $num => $item):?> 
<div data-gid="<?php echo $item['Group']['id'];?>" class="groupUnit" style="<?php
	//座標指定-----------------------------------
	if($template_type == 'x'){
		list($left,$top) = explode(',',$item['Group']['custom_point']);
	}else{
		list($left,$top) = explode(',',$template_position['point'][$num]);
	}
	printf('left:%spx;top:%spx;',$left,$top);
	//-----------------------------------座標指定
?>">
<div class="groupHandle">
[<span class="num"><?php echo $num + 1;?></span>]テーブル　<?php
if($template_type == 'x'){
	echo '<span class="delGroupBtn">☓削除</span>';
}?></div>
<ul>
<?php if($item['Guest']):?> 

<?php foreach($item['Guest'] as $g_info){
	if($g_info['GroupsGuest']['template_type']!=$template_type) continue;
	$attr_title = sprintf('%s　%s %s　%s %s　%s',
		$whose_map[$g_info['whose_guest']],
		$g_info['affiliation1'],
		$g_info['affiliation2'],
		$g_info['name_sei'],
		$g_info['name_mei'],
		$g_info['proper_title']
	);
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s" title="%s">' .
			'<p class="withAttr"><span class="whose">%s</span> ' .
			'<span class="affiliation">%s%s</span></p>' .
			'<p class="belongTo%s">%s %s %s</p></li>'."\n",
		$g_info['id'],
		$g_info['user_id'],
		$g_info['GroupsGuest']['group_id'],
		$g_info['whose_guest'],
		$attr_title,
		$whose_map[$g_info['whose_guest']],
		$g_info['affiliation1'],$g_info['affiliation2'],
		$g_info['whose_guest'],
		$g_info['name_sei'],
		$g_info['name_mei'],
		$g_info['proper_title']
	);
}?> 

<?php endif;?> 
</ul>
</div>
<?php endforeach;endif;?> 
</div>
<?php else:?> 
<em style="color:white;">使用するテンプレートを選択してください。</em>
<?php endif;?> 
</div>

<?php echo $this->element('js_seat_mapping',array('template_type' => $template_type));?> 