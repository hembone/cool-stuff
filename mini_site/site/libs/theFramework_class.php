<?php
class theFramework {

	function __construct() {
		$this->bodyClasses = array();
		$this->template = 'default';
	}

	public function init() {
		$this->getPage();
		$this->getTemplate();
	}

	private function getPage() {
		$this->page = 'home';
		if(isset($_GET['page']) && $_GET['page']!='') {
			$get_page = explode('.', $_GET['page']);
			$this->page = $get_page[0];
		}
		ob_start();
		include 'pages/'.$this->page.'.php';
		$this->pageOutput = ob_get_clean();
	}

	private function getTemplate() {
		include 'templates/'.$this->template.'.php';
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
		$bodyClassStr = '';
		foreach($this->bodyClasses as $class) {
			$bodyClassStr .= $class.' ';
		}
		echo trim($bodyClassStr);
	}

	public function printContent() {
		echo $this->pageOutput;
	}

}
?>
