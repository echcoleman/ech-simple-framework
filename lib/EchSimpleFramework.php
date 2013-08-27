<?php

include(PATH . 'lib' . DS . 'Html.php');

class EchSimpleFramework {
	
	/**
	 * Current page
	 * 
	 * @var string
	 */
	public $page;
	
	/**
	 * Current subsections
	 * 
	 * @var string
	 */
	public $subsections;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->page = $this->get_page();
		$this->subsections = $this->get_subsections();
	}
	
	/**
	 * Handle page calls
	 */
	public function page_handler() {
		// get page path
		$pagepath = PAGES_PATH . $this->page . '.php';
		if (is_file($pagepath)) {
			include($pagepath);
		}
		else {
			include(PAGES_PATH . '404.php');
		}
	}
	
	/**
	 * Get page
	 * 
	 * @return string Current page
	 */
	public function get_page() {
		
		// get page
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		else {
			$page = 'index';
		}
		$page = rtrim($page, '/');
		return $page;
	}
	
	/**
	 * Get sub sections
	 * 
	 * @return string Current subsections
	 */
	public function get_subsections() {
		
		// get section
		if (isset($_GET['section'])) {
			$section = $_GET['section'];
		}
		else {
			$section = false;
		}
		$sections = rtrim($section, '/');
		return $sections;
	}
	
	/**
	 * Return a parsed view
	 * 
	 * @param string $view View path
	 * @param array $vars Variables to pass to the view
	 * @return string Return view
	 */
	public function view($view, $vars = array()) {

		// add page and view information
		$vars['page'] = $this->page;
		$vars['sections'] = $this->subsections;

		// get view path and view
		$viewpath = VIEWS_PATH . $view . '.php';
		if ($viewpath && is_file($viewpath)) {
			$this->Html = new Html();
			extract($vars);
			ob_start();
			include($viewpath);
			$content = ob_get_clean();
		}
		else {
			$content = sprintf('Unable to locate view for: %s', $viewpath);
		}

		return $content;
	}
	
	/**
	 * Display page
	 * 
	 * @param string $title Page title
	 * @param array $params Page parameters
	 * @param string $layout Page layout. Optional
	 */
	public function display($title, $params, $layout = '1-column') {
		if (!isset($params['title'])) {
			$params['title'] = $title;
		}
		echo $this->view('layout/' . $layout, $params);
	}
}

?>
