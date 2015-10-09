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
		$filePath = 'pages/'.$this->page.'.php';
		if(!file_exists($filePath)) {
			$this->page = '404';
			$filePath = 'pages/404.php';
		}
		ob_start();
		include $filePath;
		$this->pageOutput = ob_get_clean();
	}

	private function getTemplate() {
		if($this->isApi()) {
			$this->printContent();
		} else {
			include 'templates/'.$this->template.'.php';
		}
	}

	private function isApi() {
		if(isset($_REQUEST['key']) && $_REQUEST['key']==API_KEY) {
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
