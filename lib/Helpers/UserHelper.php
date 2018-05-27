<?php

namespace Core\Helpers;

use Detection\MobileDetect;

class UserHelper {
	protected static $detect;

	/**
	 * @return MobileDetect
	 */
	protected static function getMobileDetect() {
		if (!isset(static::$detect)) {
			static::$detect = new MobileDetect();
		}

		return static::$detect;
	}

	public static function isFromSE() {
		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		if (preg_match('/^https?:\/\//', $referer)) {
			$host = parse_url($referer, PHP_URL_HOST);
			if ($host && preg_match('/(yandex|google|mail\.ru|rambler\.ru)/', $host)) {
				return true;
			}
		}

		return false;
	}

	public static function isMobile() {
		return static::getMobileDetect()->isMobile();
	}

	public static function isTablet() {
		return static::getMobileDetect()->isTablet();
	}

	public static function isAndroid() {
		return static::getMobileDetect()->isAndroidOS();
	}

	public static function isIOS() {
		return static::getMobileDetect()->isiOS();
	}
}
