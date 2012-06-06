<script type="text/javascript">//<![CDATA[
var GROUP_CAPACITY = 6;
var TOKEN = '<?php echo $token;?>';

/**
 * 招待客要素及び未所属エリアにイベントをセット
 */
function _setEventToGuestUnit()
{
	$('#guestList li').draggable({helper:'clone'});
	$('div.groupUnit ul li').draggable({
		//disabled:true,//sortableと共存するために必要
		helper:'clone'
	});
	$('#guestList').droppable({
		accept:'div.groupUnit li',
		over:function(){
			$(this).addClass('dropOver');
		},
		out:function(){
			$(this).removeClass('dropOver');
		},
		drop: function( event, ui ) {
			$(this).removeClass('dropOver');
			_returnList(ui.draggable);
		}
	});
}
/**
 * テーブル要素にdroppable、配下のulにsortableイベントをセット
 */
function _setEventToGroupUnit()
{
	$('div.groupUnit').droppable({
		accept:function(obj){
			return ($(this).find('li').length < GROUP_CAPACITY);
		},
		over:function(){
			$(this).addClass('dropOver');
		},
		out:function(){
			$(this).removeClass('dropOver');
		},
		drop: function(event,ui){
			$(this).removeClass('dropOver');
			if(ui.draggable.data('gid') == $(this).data('gid')) return false;
			_setGroup($(ui).draggable,$(this));
		}
	})
//	.find('ul').sortable({
//		placeholder:'placeholder',
//		update:function(event,ui){
//			//console.log(event,ui);
//			console.log(ui.item.parent().find('li'));
//		}
//	});
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
		var $list = $( "ul", $target ).length ?
			$( "ul", $target ) :
			$( "<ul class='ui-helper-reset'/>" ).appendTo( $target );
		$list.append($$.attr('data-gid',$target.data('gid')).show());
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
	_setEventToGuestUnit();
	_setEventToGroupUnit();
});

//]]></script>