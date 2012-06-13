<h2><?php echo $this->Session->read('UserInfo.User.user_name');?>さんのマイページ</h2>
<?php
	echo $this->Html->css('seat_mapping')."\n";
	echo $this->element('css_group')."\n";
	echo $this->element('batch_consoles')."\n";
?> 
<h3>披露宴席次表編成</h3>

<div id="console">
<p>テンプレート:<?php
	echo $this->Form->select('template',
		Configure::read('template_map'),
		$template_type = $this->Session->read('UserInfo.User.template_type'),
		array('empty'=>'--選択してください--')
	)."\n";
?>　<?php
	echo $this->Form->button('紐付リセット',array('type'=>'button','id'=>'resetRelation'))."\n";
?></p>
</div>

<div id="guestListArea">
<p id="layoutThumbWrap"><?php
	if(!$template_type) $template_type = 'x';
	echo $this->Html->image('layout_thumb-'.$template_type.'.png',array('id'=>'layoutThumb'));
?></p>
<div id="guestList">
<ul>
<?php foreach($guest_list as $g_info){
	$attr_title = sprintf('%s %s %s %s　%s %s',
		$whose_map[$g_info['Guest']['whose_guest']],
		$g_info['Guest']['affiliation1'],
		$g_info['Guest']['affiliation2'],
		$g_info['Guest']['name_sei'],
		$g_info['Guest']['name_mei'],
		$g_info['Guest']['proper_title']
	);
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s" title="%s">' .
			'<p class="belongTo%s"><span class="whose">%s</span> ' .
			'<span class="affiliation">%s%s</span></p>' .
			'%s　%s　様</li>'."\n",
		$g_info['Guest']['id'],
		$g_info['Guest']['user_id'],
		'',
		$g_info['Guest']['whose_guest'],
		$attr_title,
		$g_info['Guest']['whose_guest'],
		$whose_map[$g_info['Guest']['whose_guest']],
		$g_info['Guest']['affiliation1'],
		$g_info['Guest']['affiliation2'],
		$g_info['Guest']['name_sei'],
		$g_info['Guest']['name_mei']
	);
}?> 
</ul>
</div>
</div>

<div id="floorAreaWrap">
<?php if($template_type):?> 
<div id="floorArea" class="clearfix">
<?php if($group_list):foreach($group_list as $num => $item):?> 
<div data-gid="<?php echo $item['Group']['id'];?>" class="groupUnit">
<div class="groupSortHandle">[<span class="num"><?php echo $num + 1;?></span>]テーブルソート</div>
<ul>
<?php if($item['Guest']):?> 

<?php foreach($item['Guest'] as $g_info){
	if($g_info['GroupsGuest']['template_type']!=$template_type) continue;
	$attr_title = sprintf('%s %s %s %s　%s %s',
		$whose_map[$g_info['whose_guest']],
		$g_info['affiliation1'],
		$g_info['affiliation2'],
		$g_info['name_sei'],
		$g_info['name_mei'],
		$g_info['proper_title']
	);
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s" title="%s">' .
			'<p class="belongTo%s"><span class="whose">%s</span> ' .
			'<span class="affiliation">%s%s</span></p>' .
			'%s　%s　様</li>'."\n",
		$g_info['id'],
		$g_info['user_id'],
		$g_info['GroupsGuest']['group_id'],
		$g_info['whose_guest'],
		$attr_title,
		$g_info['whose_guest'],
		$whose_map[$g_info['whose_guest']],
		$g_info['affiliation1'],$g_info['affiliation2'],
		$g_info['name_sei'],
		$g_info['name_mei']
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

<?php echo $this->element('js_seat_mapping');?> 