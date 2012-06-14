<h2><?php echo $this->Session->read('UserInfo.User.user_name');?>さんのマイページ</h2>

<h3>招待客管理</h3>

<div id="entryFormArea">

<?php echo $this->element('form_guest');?>

</div><!--/#entryFormArea-->

<div id="guestListWrap">
<?php if($guest_list):?> 

<div>絞込み：<?php echo $this->Form->select(
	'rowFilter',
	array('0' => '全員','1' => '新郎招待客のみ','2' => '新婦招待客のみ'),null,
	array('empty' => false)
);?>　<em id="guestCount"></em>件表示中
</div>

<table class="general" id="guestList">
<thead>
<tr>
	<!--th>並替</th-->
	<th>区分</th>
	<th>所属・肩書1</th>
	<th>所属・肩書2</th>
	<th>氏名</th>
	<th>有効／無効</th>
	<th>編集</th>
	<th>削除</th>
</tr>
</thead>
<tbody>
<?php foreach($guest_list as $item){
	printf('<tr data-whose_code="%s">' .
			//'<td class="handle">%s</td>' .
			'<td>%s</td>' .
			'<td>%s</td>' .
			'<td>%s</td>' .
			'<td>%s　%s %s</td>' .
			'<td>%s</td>' .
			'<td>%s</td>' .
			'<td>%s</td>' .
			'</tr>'."\n",
		$item['Guest']['whose_guest'],
		//$this->Html->image('ico_updown.gif'),
		$whose_map[$item['Guest']['whose_guest']],
		$item['Guest']['affiliation1'],
		$item['Guest']['affiliation2'],
		$item['Guest']['name_sei'],$item['Guest']['name_mei'],$item['Guest']['proper_title'],
		$this->Form->button(
			$item['Guest']['activate'] ? '有効' : '無効',
			array('type'=>'button','data-id' => $item['Guest']['id'],'div'=>false,'class'=>'activateBtn')
		),
		$this->Form->button('編集',array('type'=>'button','data-id' => $item['Guest']['id'],'div'=>false,'class'=>'editBtn')),
		$this->Form->button('削除',array('type'=>'button','data-id' => $item['Guest']['id'],'div'=>false,'class'=>'deleteBtn'))
	);
};?>
</tbody>
</table>
</div><!--#guestListWrap-->
<script type="text/javascript">//<![CDATA[
var TOKEN = '<?php echo $token;?>';
function _consoleFix()
{
	var offset1 = $("#entryFormArea").offset();
	var fix_limit = $('#foot').offset().top - $("#entryFormArea").height() -20;
	$(window).scroll(function(e) {
		if (offset1.top < $(this).scrollTop()) {
			var limit_offset = fix_limit - $(this).scrollTop();
			if(limit_offset) var top_pos = limit_offset > 0 ? 0 : limit_offset;
			$("#entryFormArea").css({
				'position':'fixed',
				'top':top_pos,
				'z-index':100000
			});
		} else {
			$("#entryFormArea").css({
				'position':'static'
			});
		}
	});
}

function _guestFilter(whose_code)
{
	var cnt = 0;
	$('#guestList > tbody').find('tr').each(function(){
		var $$ = $(this);
		if(whose_code == '0'){
			$$.show();cnt++;
		}else{
			if($$.data('whose_code') == whose_code){
				$$.show();cnt++;
			}else{
				$$.hide();
			}
		}
	});
	$('#guestCount').text(cnt);
}
$('#rowFilter').change(function(){
	_guestFilter($(this).val())
});
$('button.editBtn').click(function(){
	var $$ = $(this);
	$.getJSON(
		ROOT_URL + '/guests/ajax_get_guest_info',
		{
			id:$$.data('id'),
			token:TOKEN
		},
		function(json){
			$('div.error-message').remove();
			$('#formTable').css('opacity',0.5);
			$('#formTable').animate({
				'opacity':1.0
			});
			$('#GuestId').val(json.Guest.id);
			$('#GuestWhoseGuest' + json.Guest.whose_guest).attr('checked',true);
			$('#GuestAffliation1').val(json.Guest.affiliation1);
			$('#GuestAffliation2').val(json.Guest.affiliation2);
			$('#GuestNameSei').val(json.Guest.name_sei);
			$('#GuestNameMei').val(json.Guest.name_mei);
			$('#GuestProperTitle' + json.Guest.proper_title).attr('checked',true);
		}
	);
});
$('button.deleteBtn').click(function(){
	var $$ = $(this);
	var target_row = $$.parents('tr');
	target_row.css('background-color','#ff9');
	if(!confirm('この招待客を削除します。よろしいですか？')){
		target_row.removeAttr('style');
		return false;
	}
	$.ajax({
		url:ROOT_URL + '/guests/ajax_delete_guest',
		type:'post',
		data:{
			id:$$.data('id'),
			token:TOKEN
		},
		beforeSend:function(){
			$$.hide().after('<?php echo $this->Html->link('ajax-loader_mini.gif');?>');
		},
		success:function(response){
			if(response == 'success'){
				target_row.fadeOut('slow',function(){
					$(this).remove();
				});
			}else{
				alert(response);
				target_row.removeAttr('style').find('img').remove();
				return false;
			}
		}
	});
});
$(function(){
	_consoleFix();
	_guestFilter($('#rowFilter').val());
});
//]]></script>
<?php endif;?> 