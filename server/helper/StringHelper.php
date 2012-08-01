<?php

	/**
	* @version 1.0
	*/
	class StringHelper {
		public static function strtohex($str) {
			$s='';

			foreach(str_split($str) as $c)
				$s .= sprintf("%02x:", ord($c));

			return $s;
		}
	}

?>
