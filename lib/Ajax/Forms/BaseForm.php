<?php

namespace Core\Ajax\Forms;

use Core\Ajax\BaseAjax;

class BaseForm extends BaseAjax {
	public static function hiddenInputs() {
		$result = wp_nonce_field(static::getNonceAction(), static::getNonceName(), true, false);
		$result .= '<input type="hidden" name="action" value="' . static::getAction() .'">';

		return $result;
	}
}