<?php

namespace App\Cv;

/**
 * Helper classes
 */
class Helper
{
	// shortcut for json read
	static function jsonRead($path)
	{
		$json = file_get_contents($path);
		$data = json_decode($json);
		return $data;
	}

	// shortcut for json write
	static function jsonWrite($data, $path)
	{
		$data = json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		file_put_contents($path, $data);
		return $data;
	}
}