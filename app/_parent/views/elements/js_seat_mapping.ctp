<script type="text/javascript">//<![CDATA[
var GROUP_CAPACITY = 6;
var TOKEN = '<?php echo $token;?>';

function _setEventToGuestUnit()
{
	$('#guestList li,div.groupUnit ul li').draggable({
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
			_setGroup(ui.draggable,$(this));
		}
	});
}
function _setGroup($$,$target)
{
	_registRelation($$,$target);
	$$.fadeOut(function() {
		var $list = $( "ul", $target ).length ?
			$( "ul", $target ) :
			$( "<ul class='ui-helper-reset'/>" ).appendTo( $target );
		$list.append($$.show());
	});
}
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
function _returnList($$) {
	$$.fadeOut(function() {
		$$.appendTo('#guestList ul')
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

})

//]]></script>