<?php declare(strict_types=1);

namespace App\Cv;

use ScssPhp\ScssPhp\Compiler;

/**
 * Html singleton
 */
class Html
{
	public $js;
	public $css;
	public Tpl $tpl;
	private static $_instance = null;

	private string $baseDir;

	public static function getInstance(): self {
		if(\is_null(self::$_instance)) {
			self::$_instance = new Html();
		}
		return self::$_instance;
	}

	private function getBaseDir() {
		return $this->baseDir ??= \dirname(__DIR__);
	}

	public function __construct()
	{
		$this->tpl = Tpl::getInstance();

		$data = Helper::jsonRead(
			$this->getBaseDir() . '/assets.json'
		);

		foreach($data as $assets){
			foreach($assets as $asset){
				$url = $asset->url;
				$integrity = $asset->integrity ?? false;
				$url_info = parse_url($url);
				$path_info = pathinfo($url_info["path"]);
				$extension = $path_info["extension"];
				switch($extension){
					case "js":
						$this->loadJs($url, $integrity);
						break;
					case "scss":
					case "css":
						$this->loadCss($url, $integrity);
						break;
				}
			}
		}
		$this->loadScss();
	}

	private function loadJs($src, $integrity = false)
	{
		$js = [
			"src" => $src,
			"integrity" => $integrity,
			"has_integrity" => !!$integrity
		];
		$this->js[] = $this->tpl->render($this->getBaseDir() . "/tpl/html/script.mu",$js);
	}

	private function loadCss($href, $integrity = null)
	{
		$css = [
			"href" => $href,
			"integrity" => $integrity,
			"has_integrity" => (bool) $integrity
		];

		$this->css[] = $this->tpl->render(
			$this->getBaseDir() . "/tpl/html/link.mu",
			$css
		);
	}

	private function loadScss()
	{
		$this->css[] = "<style>" . $this->compileScss('main.scss') . "</style>";
	}

	private function compileScss($path): string
	{
		$compiler = new Compiler();
		$compiler->setImportPaths(
			$this->getBaseDir() . '/scss/'
		);

		return $compiler
			->compileString("@import '$path';")
			->getCss()
		;
	}

	public function render($tpl, $data = false){
		return $this->tpl->render($tpl, $data);
	}

	public function page($content = null){
		if(\is_array($content)){
			$content = \implode("\n", $content);
		}
		$data = [
			"scripts" => \implode("\n",$this->js),
			"stylesheets" => \implode("\n",$this->css),
			"content" => $content
		];
		$html = $this->tpl->render(
			$this->getBaseDir() . "/tpl/index.mu",
			$data
		);

		return $html;
	}
}
