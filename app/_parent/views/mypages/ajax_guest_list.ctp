<?php //pr($guest_list);?>
<ul>
<?php foreach($guest_list as $g_info){
	printf("\t".'<li data-id="%s" data-uid="%s" data-gid="%s" data-whose="%s">%s　%s　様</li>'."\n",
		$g_info['Guest']['id'],
		$g_info['Guest']['user_id'],
		$g_info['Guest']['group_id'],
		$g_info['Guest']['whose_guest'],
		$g_info['Guest']['name_sei'],
		$g_info['Guest']['name_mei']
	);
}?> 
</ul>