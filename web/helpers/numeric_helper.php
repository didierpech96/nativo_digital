<?php

if(!function_exists('formatNumber')){
	function formatNumber($number,$decimals = 2,$decimal_separator = ".",$million_separator = ","){
		$number = str_replace(",", "", $number);
		$number = floatval($number);
		$number = round($number,$decimals,PHP_ROUND_HALF_EVEN);
		return number_format($number,$decimals,$decimal_separator,$million_separator);
	}
}

?>