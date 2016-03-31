<?php

class AppController {
	public $render;

	protected function __construct()
	{
		$this->render = new Render();

		// determine what page you're on
		$action = (isset($_GET['action']) && $_GET['action']) ? $_GET['action'] : 'index';

		$this->$action();
	}


	/**
	* set flash message
	* @type: error, success, info
	* find out more here: http://twitter.github.com/bootstrap/components.html#alerts
	*/
	protected function set_flash($value='', $status='updated')
	{
		//$mess = '<div class="alert alert-%s">%s</div>';
		$mess = '<div id="message" class="'.$status.' below-h2"><p>%s</p></div>';
		$mess = sprintf($mess, $value);
		if(isset($_SESSION['egrids_flash'])){ unset($_SESSION['egrids_flash']); }
		$_SESSION['egrids_flash'] = $mess;
	}
}
?>