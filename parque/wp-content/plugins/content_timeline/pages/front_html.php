<?php
$frontHtml = '
<style type="text/css">
#tl'. $id. ' .timeline_line,
#content #tl'. $id. ' .timeline_line{
 	width: '.$settings['line-width'].'px;
} 

#tl'.$id.' .t_line_view,
#content #tl'.$id.' .t_line_view {
 	width: '.$settings['line-width'].'px;
} 
 
#tl'.$id.' .t_line_m,
#content #tl'.$id.' .t_line_m {
	width: '. (((int)$settings['line-width'])/2-2).'px;
}
 
#tl'. $id.' .t_line_m.right,
#content #tl'. $id.' .t_line_m.right {
	left: '. (((int)$settings['line-width'])/2-1).'px;
	width: '. (((int)$settings['line-width'])/2-1).'px;
}

#tl'. $id.' .t_node_desc,
#content #tl'. $id.' .t_node_desc {
	background: '.$settings['node-desc-color'].';
}


#tl'. $id.' .item h2,
#content #tl'. $id.' .item h2 {
	font-size:'.$settings['item-header-font-size'].'px;
	color:'.$settings['item-header-font-color'].';
	line-height:'.$settings['item-header-line-height'].'px;';
	
switch($settings['item-header-font-type']) {
	case 'regular' : $frontHtml .= '
	font-weight:normal;
	font-style:normal;'; break;
	
	case 'thick' : $frontHtml .= '
	font-weight:100;
	font-style:normal;'; break;
	
	case 'bold' : $frontHtml .= '
	font-weight:bold;
	font-style:normal;'; break;
	
	case 'bold-italic' : $frontHtml .= '
	font-weight:bold;
	font-style:italic;'; break;
	
	case 'italic' : $frontHtml .= '
	font-weight:normal;
	font-style:italic;'; break;
}
$frontHtml .= '
} 
 
#tl'. $id.' .item,
#content #tl'. $id.' .item {
 	width: '. $settings['item-width'].'px;
	height: '. $settings['item-height'].'px;
	background:'. $settings['item-back-color'].' url('. $settings['item-background'].') repeat;
	font-size:'.$settings['item-text-font-size'].'px;
	color:'.$settings['item-text-font-color'].';
	line-height:'.$settings['item-text-line-height'].'px;';


switch($settings['item-text-font-type']) {
	case 'regular' : $frontHtml .= '
	font-weight:normal;
	font-style:normal;'; break;
	
	case 'thick' : $frontHtml .= '
	font-weight:100;
	font-style:normal;'; break;
	
	case 'bold' : $frontHtml .= '
	font-weight:bold;
	font-style:normal;'; break;
	
	case 'bold-italic' : $frontHtml .= '
	font-weight:bold;
	font-style:italic;'; break;
	
	case 'italic' : $frontHtml .= '
	font-weight:normal;
	font-style:italic;'; break;
}


if($settings['shadow'] == 'show') {
	$frontHtml.= '
	-moz-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	
	zoom: 1;
	filter: progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=0),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=90),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=180),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=270);
	
	';
	}
else {
	$frontHtml.= '
	-moz-box-shadow: 0 0 0 #000000;
	-webkit-box-shadow: 0 0 0 #000000;
	box-shadow: 0 0 0 #000000;';
}
$frontHtml.=' 
}';
if($settings['shadow'] == 'on-hover') {
	$frontHtml.= '
#tl'. $id . ' .item:hover,
#content #tl'. $id . ' .item:hover {
	-moz-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	
	zoom: 1;
	filter: progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=0),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=90),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=180),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=270);
	
	
}';
}

$frontHtml.= '


#tl'. $id.' .item_open h2,
#content #tl'. $id.' .item_open h2 {
	font-size:'.$settings['item-open-header-font-size'].'px;
	color:'.$settings['item-open-header-font-color'].';
	line-height:'.$settings['item-open-header-line-height'].'px;';
	
switch($settings['item-open-header-font-type']) {
	case 'regular' : $frontHtml .= '
	font-weight:normal;
	font-style:normal;'; break;
	
	case 'thick' : $frontHtml .= '
	font-weight:100;
	font-style:normal;'; break;
	
	case 'bold' : $frontHtml .= '
	font-weight:bold;
	font-style:normal;'; break;
	
	case 'bold-italic' : $frontHtml .= '
	font-weight:bold;
	font-style:italic;'; break;
	
	case 'italic' : $frontHtml .= '
	font-weight:normal;
	font-style:italic;'; break;
}
$frontHtml .= '
}

#tl'. $id .' .item_open,
#content #tl'. $id .' .item_open{
 	width: '. $settings['item-open-width'].'px;
	height: '. $settings['item-height'].'px;
	background:'. $settings['item-open-back-color'].' url('. $settings['item-open-background'].') repeat;
	font-size:'.$settings['item-open-text-font-size'].'px;
	color:'.$settings['item-open-text-font-color'].';
	line-height:'.$settings['item-open-text-line-height'].'px;';
	
switch($settings['item-open-text-font-type']) {
	case 'regular' : $frontHtml .= '
	font-weight:normal;
	font-style:normal;'; break;
	
	case 'thick' : $frontHtml .= '
	font-weight:100;
	font-style:normal;'; break;
	
	case 'bold' : $frontHtml .= '
	font-weight:bold;
	font-style:normal;'; break;
	
	case 'bold-italic' : $frontHtml .= '
	font-weight:bold;
	font-style:italic;'; break;
	
	case 'italic' : $frontHtml .= '
	font-weight:normal;
	font-style:italic;'; break;
}
 	
	
if($settings['shadow'] == 'show' || $settings['shadow'] == 'on-hover') {
	$frontHtml.= '
	-moz-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	box-shadow: 0px 0px 6px rgba(0,0,0,0.5);
	
	zoom: 1;
	filter: progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=0),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=90),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=5, Direction=180),
		progid:DXImageTransform.Microsoft.Shadow(Color=#888888, Strength=0, Direction=270);
	
	';
	}
	else {
	$frontHtml.= '
	-moz-box-shadow: 0 0 0 #000000;
	-webkit-box-shadow: 0 0 0 #000000;
	box-shadow: 0 0 0 #000000;';
	} 
$frontHtml.= '
 }'. '
 
#tl'. $id.' .item .con_borderImage,
#content #tl'. $id.' .item .con_borderImage {
 	border:0px;
 	border-bottom: '. $settings['item-image-border-width'].'px solid '. $settings['item-image-border-color'].' ; 
}
 
#tl'. $id.' .item_open .con_borderImage,
#content #tl'. $id.' .item_open .con_borderImage {
 	border-bottom: '. $settings['item-open-image-border-width'].'px solid '. $settings['item-open-image-border-color'].' ; 
}

#tl'. $id.' .item_open_cwrapper,
#content #tl'. $id.' .item_open .con_borderImage {
 	width: '. $settings['item-open-width'].'px;
}

#tl'. $id.' .item_open .t_close:hover,
#content #tl'. $id.' .item_open .t_close:hover{
	background:'. $settings['button-hover-color'].';
}

#tl'. $id.' .item .read_more:hover,
#content #tl'. $id.' .item .read_more:hover{
	background:'. $settings['button-hover-color'].';
}


#tl'. $id.' .item .read_more,
#content #tl'. $id.' .item .read_more,
#tl'. $id.' .item_open .t_close,
#content #tl'. $id.' .item_open .t_close {

	/* transparent background */
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=\'#44000000\', endColorstr=\'#44000000\'); 
}

#tl'. $id.' .t_node_desc,
#content #tl'. $id.' .t_node_desc,
 {

	/* IE transparent background */
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=\'#cc1a86ac\', endColorstr=\'#cc1a86ac\'); 
}



#tl'. $id.' .timeline_open_content,
#content #tl'. $id.' .timeline_open_content {
	padding:'. $settings['item-open-content-padding'].'px;
}



</style>
';

$frontHtml .='

<!-- BEGIN TIMELINE -->
<div id="tl'. $id.'" class="timeline'. ($settings['line-style'] == 'dark' ? ' darkLine' : ''). ($settings['nav-style'] == 'dark' ? ' darkNav' : '').'">';

if($itemsArray) {
	$iteration = -1;
	foreach ($itemsArray as $key => $arr) {
		$num = substr($key,4);
		$iteration++;
		
		if($settings['cat-type'] == 'categories') {
			$index = array_search($arr['categoryid'],$catArray);
			$ccNumbers[$index]++;
			$arr['dataid'] = ($ccNumbers[$index] < 10 ? '0'.$ccNumbers[$index] : $ccNumbers[$index]).'/'.$arr['categoryid'];
		}
		if(array_key_exists('start-item', $arr)) {
			$start_item = $arr['dataid'];
			
		}
$image = '';
if($arr['item-image'] != '') {
	$imgw = (int)$settings['item-width'];
	$imgh = (int)$settings['item-image-height'];
	$image = bro_images::get_image($arr['item-image'], $imgw, $imgh);
	$image = '<img src="'. $image .'" alt=""/>';
}
		
$image = (($image != '' && $arr['item-prettyPhoto'] != '') ? '<a class="timeline_rollover_bottom con_borderImage" href="'.$arr['item-prettyPhoto'].'" rel="prettyPhoto[timeline]">'.$image.'</a>':$image);

$readMore = '';
if($settings['read-more'] == 'button') {
	if(isset($arr['item-link']) && $arr['item-link'] != '') {
		$readMore = '<a class="read_more" href="'.$arr['item-link'].'">'.$settings['more-text'].'</a>';
	}
	else {
		$readMore = '<div class="read_more" data-id="'.$arr['dataid'].'">'.$settings['more-text'].'</div>';
	}
}
$frontHtml .='

		<div class="item" data-id="'. $arr['dataid'].'"'.(($arr['node-name'] && $arr['node-name'] != '') ? ' data-name="'.$arr['node-name'].'"': '').' data-description="'. substr($arr['item-title'],0,30).'">
			'.$image.'
			<h2>'.$arr['item-title'].'</h2>
			<span>'.$arr['item-content'].'</span>
			'.$readMore.'
		</div>
		<div class="item_open" data-id="'.$arr['dataid'].'" '.(!isset($tpreview) ? 'data-access="'.admin_url( 'admin-ajax.php' ).'?action=ctimeline_frontend_get&timeline='.$id.'&id='.$key.'"': '').'>
			<div class="item_open_content">';
if(!isset($tpreview)) {
	$frontHtml.='
	 			<img class="ajaxloader" src="'. $this->url .'images/loadingAnimation.gif" alt="" />';
}
else {
	if ($arr['item-open-image'] != '') {
					$frontHtml .= '
			<a class="timeline_rollover_bottom con_borderImage" href="'.(($arr['item-open-prettyPhoto'] != '')? $arr['item-open-prettyPhoto'] : $arr['item-open-image']).'" rel="prettyPhoto[timeline]">';
	$image = '';
	if($arr['item-image'] != '') {
		$imgw = (int)$settings['item-open-width'];
		$imgh = (int)$settings['item-open-image-height'];
		$image = bro_images::get_image($arr['item-open-image'], $imgw, $imgh);
		$image = '<img src="'. $image .'" alt=""/>';
	}
			$frontHtml .= '
			'.$image. '</a>
			<div class="timeline_open_content'.(!array_key_exists('desable-scroll', $arr) ? ' scrollable-content' : '').'" style="height: '. $open_content_height.'px">';
			
				} 
				else { 
					$frontHtml .= '
			<div class="timeline_open_content'.(!$arr['desable-scroll'] ? ' scrollable-content' : '').'" style="height: '. (intval($settings['item-height']) - 2*intval($settings['item-open-content-padding'])).'px">';
				}
			
				if ($arr['item-open-title'] != '') { 
					$frontHtml .= '
				<h2>'.$arr['item-open-title'].'</h2>';
				} 
				$frontHtml .= '
				' .stripslashes($arr['item-open-content']).'
			</div>';
}
$frontHtml.='
			</div>
		</div>';
		

	}
}
$frontHtml .= '
</div> <!-- END TIMELINE -->
';
?>