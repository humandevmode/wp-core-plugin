<?php

add_filter('upload_mimes', function ($mimes) {
	if (current_user_can('administrator')) {
		$mimes['svg'] = 'image/svg+xml';
	}

	return $mimes;
});
