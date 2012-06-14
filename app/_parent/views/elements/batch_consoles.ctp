<link rel="stylesheet" href="<?php echo ROOT_URL;?>/css/progressbar.css" />
<?php echo $this->Html->css(array('progressbar'))."\n";?>
<script type="text/javascript">//<![CDATA[

	function Zend_ProgressBar_Update(data)
	{
		$('#pg-percent').css('width',data.percent + '%');
		$('#pg-text-1').html(data.text + ':' +data.percent + '%');
		$('#pg-text-2').html(data.text + ':' +data.percent + '%');
	}
	
	function Zend_ProgressBar_Finish()
	{
		iframe_obj = dispSwitchConsole(null,'on');
	}
	
	var pdfType = null;
	/**
	 * 非同期取得したパーツにthickboxイベントを手動でセット
	 * @param mixed link thickboxを起動する要素のjQueryオブジェクト
	 */
	function __thickbox_ext(link) {
		var t = link.title || link.name || null;
		var a = link.href || link.alt;
		var g = link.rel || false;
		tb_show(t,a,g);
		link.blur();
		return false;
	}
	function __withIdxStatus()
	{
		switch(pdfType){
			case 'simple_list':var chkform = $('#withIdx1');break;
			case 'prog_list':var chkform = $('#withIdx2');break;
			case 'integ':return true;break;
		}
		if(!chkform) return false;
		return chkform.attr('checked');
	}
	function __setLimit()
	{
		$('#limit1,#limit2').val($('#limit').val());
	}
	function dispSwitchConsole(obj,mode)
	{
		if($('#withDebug').attr('checked')){
			$(obj).attr('target','_blank');
		}else{
			$(obj).attr('target','pgframe');
		}
		switch(mode){
			case 'on':
				$('<iframe>')
				.css({width:'100%',height:'120px'})
				.attr({
					id:'statusWindow',
					src:'<?php echo ROOT_URL;?>/batches/batch/token:<?php echo $token;?>/?TB_iframe=true&width=700&height=500'
				})
				.appendTo('#iframeWrap');
				break;
			case 'off':
				__setLimit();
				$("#guestListArea").css({
					'position':'static'
				});
				$('#pg-percent').removeAttr('style');
				$('#pg-text-1').html('');
				$('#pg-text-2').html('<?php echo $this->Html->image('standby.gif',array('alt'=>'待機中'));?>');
				$('#statusWindow').remove();
				$('#progressBarWrap').show();
				break;
		}
		$('#exec').attr('disabled',true);
		$('#execSchedule').attr('disabled',true);
		
		return true;
	}
	
$(function(){
	$('#pdfGenHead').click(function(){
		var target_area = $('#consoleWrap');
		if(target_area.is(':hidden')){
			$(this).find('.areaFold').text('－');
			target_area.slideDown();
		}else{
			$(this).find('.areaFold').text('＋');
			target_area.slideUp();
		}
	});
});
//]]></script>

<h3 id="pdfGenHead"><span class="areaFold">＋</span>　PDF生成</h3>

<div id="consoleWrap" style="display:none;">

<table>
<tr>
<td>
<?php if(is_dev()):?>
<?php echo $form->checkbox('with_debug',array('id'=>'withDebug'));?> 
<label for="withDebug">デバッグ用に別ウィンドウで起動する</label>　
<?php //echo $form->text('limit',array('id'=>'limit','class'=>'x-small'));?> 
<?php endif;?>

<?php
$option = array(
	'action'=>'index',
	'type'=>'post','target'=>'pgframe',
	'onsubmit'=>'return dispSwitchConsole(this,"off");'
);
echo $form->create('Batch',$option);?> 

<?php echo $form->hidden('token',array('name'=>'token','value'=>$token));?> 
<?php echo $form->hidden('limit',array('id'=>'limit1','name'=>'limit','value'=>''));?> 
<?php echo $form->button(
	$this->Html->image('ico_make_pdf.png').' 生成開始',
	array('id'=>'makePdfBtn'));?> 
<?php echo $form->end();?> 

</td>
<td>

<div id="progressBarWrap">
<?php echo $this->element('progressbar');?> 
</div>

</td>
</tr>
</table>

<iframe name="pgframe" id="pgframe"></iframe>
<div id="iframeWrap"></div>

</div><!--/consoleWrap-->
