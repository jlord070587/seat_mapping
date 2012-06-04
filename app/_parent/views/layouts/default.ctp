<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?> 
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<title><?php echo $title_for_layout; ?>|ブライダル管理システム</title>
	<?php echo $this->Html->meta('icon');?> 
	<?php echo $this->Html->css(array('common','default'));?> 
	<?php echo $scripts_for_layout;?>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<?php echo $this->Html->script('jquery-ui-1.8.20.custom.min.js');?> 
	<script type="text/javascript">//<![CDATA[
	var ROOT_URL = '<?php echo ROOT_URL;?>';
	//]]></script>
</head>
<body>
	<div id="wrapper">
		<div id="head">
			<h1>ブライダル管理システム</h1>
		</div>
		<div id="contents">
		<div id="main">
<?php echo $this->Session->flash(); ?> 
<?php echo $content_for_layout; ?> 
		</div>
		</div>
		<div id="foot">
		<p>&copy;office-ymd</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>