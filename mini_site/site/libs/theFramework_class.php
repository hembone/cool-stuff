<?php
class theFramework {

	function __construct() {
		$this->bodyClasses    = array();
		$this->preloadStyles  = array();
		$this->styles         = array();
		$this->preloadScripts = array();
		$this->scripts        = array();
		$this->page           = 'home';
		$this->template       = 'default';
	}

	public function init() {
		$this->getPage();
		$this->getTemplate();
	}

	private function getPage() {
		if(isset($_GET['page']) && $_GET['page']!='') {
			$get_page = explode('.', $_GET['page']);
			$this->page = $get_page[0];
		}
		$filePath = 'pages/'.$this->page.'.php';
		if(!file_exists($filePath)) {
			$this->page = '404';
			$filePath   = 'pages/404.php';
		}
		ob_start();
		include $filePath;
		$this->pageOutput = ob_get_clean();
	}

	private function getTemplate() {
		if($this->isApi()) {
			$this->printContent();
		} else {
			require 'includes/routers.php';
			require 'templates/'.$this->template.'.php';
		}
	}

	private function isApi() {
		if(isset($_REQUEST['key']) && $_REQUEST['key'] == API_KEY) {
			return true;
		} else {
			return false;
		}
	}

	public function useTemplate($template='') {
		if($template!='') {
			$this->template = $template;
		}
	}

	public function addBodyClass($bodyClass='') {
		if(gettype($bodyClass)=='array') {
			foreach($bodyClass as $class) {
				array_push($this->bodyClasses, $class);
			}
		}
		if(gettype($bodyClass)=='string') {
			array_push($this->bodyClasses, $bodyClass);
		}
	}

	public function printBodyClasses() {
		$this->bodyClasses[] = $this->page;
		$bodyClassStr        = '';
		foreach($this->bodyClasses as $class) {
			$bodyClassStr .= $class.' ';
		}
		echo trim($bodyClassStr);
	}

	public function addStyle($styles='', $preload=false) {
		if(gettype($styles)=='array') {
			foreach($styles as $style) {
				if($preload) {
					array_push($this->preloadStyles, $style);
				} else {
					array_push($this->styles, $style);
				}
			}
		}
		if(gettype($styles)=='string') {
			if($preload) {
				array_push($this->preloadStyles, $styles);
			} else {
				array_push($this->styles, $styles);
			}
		}
	}

	public function printStyles($preload=false) {
		$styles = $this->styles;
		if($preload) {
			$styles = $this->preloadStyles;
		}
		if(!empty($this->styles)) {
			foreach($this->styles as $style) {
				echo '<link rel="stylesheet" type="text/css" href="'.$style.'">';
			}
		}
	}

	public function addScript($scripts='', $preload=false) {
		if(gettype($scripts)=='array') {
			foreach($scripts as $script) {
				if($preload) {
					array_push($this->preloadScripts, $script);
				} else {
					array_push($this->scripts, $script);
				}
			}
		}
		if(gettype($scripts)=='string') {
			if($preload) {
				array_push($this->preloadScripts, $scripts);
			} else {
				array_push($this->scripts, $scripts);
			}
		}
	}

	public function printScripts($preload=false) {
		$scripts = $this->scripts;
		if($preload) {
			$scripts = $this->preloadScripts;
		}
		if(!empty($scripts)) {
			foreach($scripts as $script) {
				echo '<script type="text/javascript" src="'.$script.'"></script>';
			}
		}
	}

	public function printContent() {
		echo $this->pageOutput;
	}

}
?>
