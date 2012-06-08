<h2><?php echo $this->Session->read('UserInfo.User.user_name');?>さんのマイページ</h2>

<h3>披露宴席次表編成</h3>

<div id="guestListArea">
<p><?php
	echo $this->Form->button('リセット',array('type'=>'button','id'=>'resetRelation'))."\n";
?></p>
<div id="guestList">
<ul>
<?php foreach($guest_list as $g_info){
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s">%s %s%s<br />%s　%s　様</li>'."\n",
		$g_info['Guest']['id'],
		$g_info['Guest']['user_id'],
		$g_info['Guest']['group_id'],
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

<div id="floorArea">
<?php if($group_list):foreach($group_list as $item):?> 
<div data-gid="<?php echo $item['Group']['id'];?>" class="groupUnit">
<div class="groupSortHandle">テーブルソート</div>
<ul>
<?php if($item['Guest']):?> 

<?php foreach($item['Guest'] as $g_info){
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s">%s %s%s<br />%s　%s　様</li>'."\n",
		$g_info['id'],
		$g_info['user_id'],
		$g_info['group_id'],
		$g_info['whose_guest'],
		$whose_map[$g_info['whose_guest']],
		$g_info['affiliation1'],
		$g_info['affiliation2'],
		$g_info['name_sei'],
		$g_info['name_mei']
	);
}?> 

<?php endif;?> 
</ul>
</div>
<?php endforeach;endif;?> 
</div>

<?php echo $this->element('js_seat_mapping');?> 