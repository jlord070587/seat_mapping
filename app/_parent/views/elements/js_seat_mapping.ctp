<script type="text/javascript">//<![CDATA[
var GROUP_CAPACITY = 10;
var TOKEN = '<?php echo $token;?>';
var MAX_G_UNIT_Z_INDEX = 50;
function _consoleFix()
{
	var offset1 = $("#guestListArea").offset();
	var fix_limit = $('#foot').offset().top - $("#guestListArea").height() -20;
	$(window).scroll(function(e) {
		if (offset1.top < $(this).scrollTop()) {
			var limit_offset = fix_limit - $(this).scrollTop();
			if(limit_offset) var top_pos = limit_offset > 0 ? 0 : limit_offset;
			$("#guestListArea").css({
				'position':'fixed',
				'top':top_pos,
				'width':'200px',
				'z-index':100000
			});
		} else {
			$("#guestListArea").css({
				'position':'static'
			});
		}
	});
}
/**
 * 紐付けを完全に破棄するリセットイベントセット
 */
function _setEventResetButton()
{
	$('#resetRelation').click(function(){
		if(!confirm('現在のテンプレート各テーブルへの紐付けを全てリセットします。\n本当によろしいですか？')) return false;
		location.href = ROOT_URL + "/mypages/reset_relation";
	});
}
/**
 * テーブルユニット追加イベントセット
 */
function _setEventAddGroupButton()
{
	$('#addGroup').click(function(){
		if(!confirm('テーブルを追加してよろしいですか？')) return false;
		$.getJSON(
			ROOT_URL + '/mypages/ajax_add_group',
			{
				token:TOKEN
			},
			function(json){
				if(json == 'failure'){
					alert(response);
					return false;
				}
				var add_unit = $('div.groupUnit:last').clone()
					.addClass('lastAdd')
					.css({'left':10,'top':10}).attr('data-gid',json.id);
				var num_span = add_unit.find('span.num');
				num_span.text(num_span.text() - 0 + 1);
				add_unit.find('li').remove();
				add_unit.appendTo('#floorArea');
				_setEventToGroupUnit();
			}
		);
	});
}
/**
 * テンプレ選択イベントセット
 */
function _setEventTemplateSelect()
{
	$('#template').change(function(){
		//if(!$(this).val()) return false;
		location.href = ROOT_URL
		 + '/mypages/switch_template/template_type:'
		 + $(this).val();
	});
}
/**
 * 招待客要素及び未所属エリアにイベントをセット
 */
function _setEventToGuestUnit()
{
	$('#guestList').droppable({
		accept:'div.groupUnit li',
		over:function(event, ui){
			$(this).addClass('dropOver');
		},
		out:function(){
			$(this).removeClass('dropOver');
		},
		drop: function( event, ui ) {
			$(this).removeClass('dropOver');
			_returnList(ui.draggable);
		}
	}).find('li').draggable({helper:'clone'});
}
function __setSortableOnGroupUnit()
{
	$('div.groupUnit').find('ul').sortable({
		placeholder:'placeholder',
		update:function(event,ui){
			if(ui.item.hasClass('ngSort')){
				ui.item.removeClass('ngSort');
			}else{
				_sortOnGroupUnit(ui.item.parent());
			}
		}
	}).find('li').draggable({
		disabled:true,//sortableと共存するために必要
		helper:'clone'
	});
}
function __setDroppableOnGroupUnit()
{
	$('div.groupUnit').droppable({
		accept:function(draggable){
			if(draggable.hasClass('groupUnit')) return false;
			return ($(this).find('li').length < GROUP_CAPACITY);
		},
		over:function(event,ui){
			$(this).addClass('dropOver');
			if(ui.draggable.data('gid') != $(this).data('gid')){
				ui.draggable.draggable('enable');
				ui.draggable.addClass('ngSort');
			}
		},
		out:function(){
			$(this).removeClass('dropOver');
		},
		drop: function(event,ui){
			$(this).removeClass('dropOver');
			if(ui.draggable.data('gid') != $(this).data('gid')) _setGroup(ui.draggable,$(this));
		}
	});
}
//function _registGroupSort()
//{
//	var sort_arr = [];
//	var i = 1;
//	$('div.groupUnit').each(function(){
//		var $$ = $(this);
//		$$.find('span.num').text(i);
//		sort_arr.push($$.data('gid'));
//		i++;
//	});
//	$.ajax({
//		url:ROOT_URL + '/mypages/ajax_regist_sort',
//		type:'post',
//		data:{
//			model:'Group',
//			sort_str:sort_arr.join('#'),
//			token:TOKEN
//		},
//		success:function(response){
//			if(response != 'success') alert(response);
//		}
//	});
//}

function _registGroupPos(ui,active_elem)
{
	$.ajax({
		url:ROOT_URL + '/mypages/ajax_update_group_pos',
		type:'post',
		data:{
			gid:active_elem.data('gid'),
			custom_point:ui.position.left + ',' + ui.position.top,
			token:TOKEN
		},
		success:function(response){
			if(response != 'success'){
				alert(response);
				active_elem.css({
					'top':ui.originalPosition.top,
					'left':ui.originalPosition.left
				})
			}
		}
	});
}

function _deleteGroupUnit(g_unit)
{
	$.ajax({
		url:ROOT_URL + '/mypages/ajax_delete_group_unit',
		type:'post',
		data:{
			gid:g_unit.data('gid'),
			token:TOKEN
		},
		success:function(response){
			if(response == 'failure'){
				alert(response);
				return false;
			}
			g_unit.fadeOut('slow',function(){
				$(this).remove();
			});
		}
	});
}
/**
 * テーブル要素にdroppable、配下のulにsortableイベントをセット
 */
function _setEventToGroupUnit()
{
//	$('#floorArea').sortable({
//		handle:'.groupSortHandle',
//		activate:function(){
//			$('div.groupUnit').droppable('disable');
//		},
//		deactivate:function(){
//			$('div.groupUnit').droppable('enable');
//		},
//		update:function(event,ui){
//			_registGroupSort();
//		}
//	});
<?php if($template_type=='x'):?> 
	$('div.groupUnit').draggable({
		grid:[10,10],
		containment:'parent',
		handle:'.groupHandle',
		opacity:0.5,
		start:function(e,ui){
			var z_index = $(this).css('z-index');
			if(z_index == 'auto'){
				z_index = MAX_G_UNIT_Z_INDEX;
			}else{
				if(z_index < MAX_G_UNIT_Z_INDEX) z_index = MAX_G_UNIT_Z_INDEX;
				else z_index = MAX_G_UNIT_Z_INDEX++;
			}
			$(this).css('z-index',z_index);
		},
		stop:function(e,ui){
			_registGroupPos(ui,$(this));
			$(this).removeClass('lastAdd');
		}
	});
	$('span.delGroupBtn').click(function(){
		var $$ = $(this);
		var g_unit = $$.parents('div.groupUnit');
		if(g_unit.find('li').length > 0){
			alert('招待客が紐付いたテーブルは削除できません。');
			return false;
		}
		if($('div.groupUnit').length == 1){
			alert('テーブルは少なくとも1つは必要です。');
			return false;
		}
		if(!confirm($$.siblings('span.num').text()
			 + '番テーブルを削除しようとしています。\n本当によろしいですか？')) return false;
		_deleteGroupUnit(g_unit);
	});
<?php endif;?> 
	__setDroppableOnGroupUnit();
	__setSortableOnGroupUnit();
}
function _sortOnGroupUnit(group)
{
	var sort_arr = [];
	group.find('li').each(function(){
		var $$ = $(this);
		sort_arr.push($$.data('id'));
	});
	$.ajax({
		url:ROOT_URL + '/mypages/ajax_regist_sort',
		type:'post',
		data:{
			model:'GroupGuest',
			sort_str:sort_arr.join('#'),
			gid:group.parent().data('gid'),
			token:TOKEN
		},
		success:function(response){
			if(response != 'success') alert(response);
		}
	});
}
/**
 * 招待客をテーブルに移す
 * @param array $$ ソート対象要素の配列
 * @param mixed $target ドロップ対象要素
 */
function _setGroup($$,$target)
{
	_registRelation($$,$target);
	$$.fadeOut(function() {
		$$.remove();//必須
		var $list = $( "ul", $target ).length ?
			$( "ul", $target ) :
			$( "<ul class='ui-helper-reset'/>" ).appendTo( $target );
		$list.append($$.attr('data-gid',$target.data('gid')).show());
		__setSortableOnGroupUnit();
	});
}
/**
 * 招待客を未所属エリアに移す
 * @param array $$ ソート対象要素の配列
 * @return array
 */
function _sortList(list)
{
	var sort_hash_arr = [];
	list.each(function(){
		var $$ = $(this);
		sort_hash_arr.push({num:$$.data('id'),obj:$$});
	});
	sort_hash_arr.sort(function(x,y){
		return x.num - y.num;
	});
	return sort_hash_arr;
}
/**
 * 招待客を未所属エリアに移す
 * @param mixed $$ ドロップ対象要素
 */
function _returnList($$) {
	$$.fadeOut(function() {
		$$.attr('data-gid','').appendTo('#guestList ul');
		var list_set = $('#guestList ul li');
		$('#guestList ul li').remove();
		sort_hash_arr = _sortList(list_set.draggable({
			helper:'clone'
		}));
		$.each(sort_hash_arr,function(i,val){
			$('#guestList ul').append(val.obj.show());
		});
	});
	_setGroup($$,null);
}
/**
 * 招待客をテーブルもしくは未所属に紐付ける
 * @param mixed $$ ドロップ対象要素
 * @param mixed $target ドロップ先要素
 */
function _registRelation($$,$target)
{
	var id = $$.data('id');
	var dest = $target ? $target.data('gid') : null;
	$.ajax({
		url:ROOT_URL + '/mypages/ajax_regist_relation',
		type:'post',
		data:{
			id:id,
			gid:dest,
			token:TOKEN
		},
		success:function(response){
			if(response != 'success') alert(response);
		}
	});
}

$(function(){
	_consoleFix();
	_setEventResetButton();
	_setEventAddGroupButton();
	_setEventTemplateSelect();
	_setEventToGuestUnit();
	_setEventToGroupUnit();
});

//]]></script>