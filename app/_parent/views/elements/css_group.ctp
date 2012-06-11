<?php
$css_map = array(
	'1' => array('floor_area_width' => 810),
);
$template_type = $this->Session->read('UserInfo.User.template_type');
?>
<style type="text/css"><!--
#floorArea {
	width:<?php echo $css_map[$template_type]['floor_area_width'];?>px;
}
--></style>