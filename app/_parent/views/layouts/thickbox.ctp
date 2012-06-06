<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<?php echo $this->Html->css(array('common','default'));?> 
<?php echo $scripts_for_layout;?>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<?php echo $this->Html->script('jquery-ui-1.8.20.custom.min.js');?> 

<script type="text/javascript">//<![CDATA[
var ROOT_URL = '<?php echo ROOT_URL;?>';
//]]></script>
<title><?php echo $title_for_layout; ?>|ブライダル管理システム</title>
</head>

<body class="forThickBox">
<noscript><b>JavaScriptを有効に設定してご利用ください。</b><hr></noscript>

<div id="wrapper">

<div id="contents">

<?php echo $content_for_layout; ?>

</div><!-- /contents -->


</div><!-- /wrapper -->

<?php if (Configure::read() > 0):?>
<div id="myDebug">
<fieldset>
<legend>Post</legend>
<?php pr($this->data);?>
</fieldset>

<fieldset>
<legend>Session</legend>
<?php pr($_SESSION);?>
</fieldset>
<?php echo $this->element('sql_dump');?>
<?php endif;?>

</body>
</html>