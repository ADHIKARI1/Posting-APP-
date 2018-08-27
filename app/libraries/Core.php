<?php


/*
*APP core controller
*Create URL & loads controller
*URL FORMAT - /controller/method/params
*/

class Core
{
	protected $currentController = 'pages';
	protected $currentMethode = 'index';
	protected $params = [];
	
	function __construct()
	{
		//print_r($this->getUrl());
		$url = $this->getUrl();
		if (file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
			$this->currentController = ucwords($url[0]);
			//print_r($url);
			unset($url[0]);
		}

		require_once("../app/controllers/".$this->currentController.'.php');
		$this->currentController = new $this->currentController;

		//check for 2 part of url for methode
		if (isset($url[1])) {

			if (method_exists($this->currentController, $url[1])) {
				$this->currentMethode = $url[1];
				//print_r($url);
				unset($url[1]);
			}
		}

		//echo $this->currentMethode;

		//get params
		$this->params = $url ? array_values($url) : [];
		//print_r($url);
		call_user_func_array([$this->currentController, $this->currentMethode], $this->params);

	}

	public function getUrl()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url']);
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			return $url;
		}
		
	}
}






?>