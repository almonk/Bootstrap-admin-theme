<?php

foreach($notices as $notice) {

	$class = 'alert-message info';
	$icon = 'ui-icon-success';

	if($notice instanceof NoticeError) {
		$class = 'alert-message error'; 
		$icon = ''; 
	}

	$text = $notice->text; 
	if($notice->class && $config->debug) $text = "{$notice->class}: $text";

	echo "\n\t\t<div class='$class'><p>{$text}</p></div>";

}


