<?php

add_filter('upload_mimes', function ($mimes) {
	if (current_user_can('administrator')) {
		$mimes['svg'] = 'image/svg+xml';
	}

	return $mimes;
});

add_filter('get_the_time', 'register_russian_datetime');
add_filter('get_the_date', 'register_russian_datetime');
add_filter('get_the_modified_date', 'register_russian_datetime');
add_filter('get_post_time', 'register_russian_datetime');
add_filter('get_comment_date', 'register_russian_datetime');
function register_russian_datetime($date = '') {
	if (substr_count($date, '---') > 0) {
		return str_replace('---', '', $date);
	}

	$replaces = [
		'Январь' => 'января',
		'Февраль' => 'февраля',
		'Март' => 'марта',
		'Апрель' => 'апреля',
		'Май' => 'мая',
		'Июнь' => 'июня',
		'Июль' => 'июля',
		'Август' => 'августа',
		'Сентябрь' => 'сентября',
		'Октябрь' => 'октября',
		'Ноябрь' => 'ноября',
		'Декабрь' => 'декабря',

		'January' => 'января',
		'February' => 'февраля',
		'March' => 'марта',
		'April' => 'апреля',
		'May' => 'мая',
		'June' => 'июня',
		'July' => 'июля',
		'August' => 'августа',
		'September' => 'сентября',
		'October' => 'октября',
		'November' => 'ноября',
		'December' => 'декабря',

		'Jan' => 'янв',
		'Feb' => 'фев',
		'Mar' => 'март',
		'Apr' => 'апр',
		'Jun' => 'июн',
		'Jul' => 'июл',
		'Aug' => 'авг',
		'Sep' => 'сен',
		'Oct' => 'окт',
		'Nov' => 'ноя',
		'Dec' => 'дек',

		'Sunday' => 'воскресенье',
		'Monday' => 'понедельник',
		'Tuesday' => 'вторник',
		'Wednesday' => 'среда',
		'Thursday' => 'четверг',
		'Friday' => 'пятница',
		'Saturday' => 'суббота',

		'Sun' => 'воскресенье',
		'Mon' => 'понедельник',
		'Tue' => 'вторник',
		'Wed' => 'среда',
		'Thu' => 'четверг',
		'Fri' => 'пятница',
		'Sat' => 'суббота',

		'th' => '',
		'st' => '',
		'nd' => '',
		'rd' => '',
	];

	return strtr($date, $replaces);
}
