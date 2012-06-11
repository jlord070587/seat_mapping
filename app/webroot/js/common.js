function _flashMsgOperation()
{
	if($('#flashMessage').length==0) return;
	setInterval(function(){
		if($('#flashMessage').hasClass('afterHide')){
			$('#flashMessage').addClass('afterHide');
		}else{
			$('#flashMessage').remove();
			clearInterval();
		}
	},5000);
}

$(function(){
	_flashMsgOperation();
});