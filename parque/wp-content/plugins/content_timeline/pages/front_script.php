<?php
$frontHtml .= '

<script type="text/javascript">
(function($){
$(window).load(function() {
	
	$(".scrollable-content").mCustomScrollbar();
	$("a[rel^=\'prettyPhoto\']").prettyPhoto();
	
	$("#tl'.$id.'").timeline({
		itemMargin : '. $settings['item-margin'].',
		scrollSpeed : '.$settings['scroll-speed'].',
		easing : "'.$settings['easing'].'",
		openTriggerClass : '.$read_more.',
		swipeOn : '.$swipeOn.',
		startItem : "'. (!empty($start_item) ? $start_item : 'last') . '",
		yearsOn : '.(($settings['hide-years'] || $settings['cat-type'] == 'categories') ? 'false' :  'true').',
		hideTimeline : '.($settings['hide-line'] ? 'true' : 'false').',
		hideControles : '.($settings['hide-nav'] ? 'true' : 'false').',
		closeText : "'.$settings['close-text'].'"'.
		$cats.'
	});
	
});	
})(jQuery);
</script>';
?>