<?php declare(strict_types=1);

namespace App\Cv;

use Mustache_Engine;

/**
* Mustache singleton
*/
class Tpl
{
	private Mustache_Engine $mustache;
	private static $_instance = null;

	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new Tpl();
		}
		return self::$_instance;
	}

	private function getMustache(){
		return $this->mustache ??= new Mustache_Engine();
	}

	// raccourci
	public function loadFile($path){
		if(!isset($this->tpl[$path])){
			$this->tpl[$path] = \file_get_contents($path);
		}
		return $this->tpl[$path];
	}

	// raccourci
	public function render($path, $data = array()){
		return $this->getMustache()->render(
			$this->loadFile($path),
			$data
		);
	}
}