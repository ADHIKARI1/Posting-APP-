<?php

/**
* 
*/
class Pages extends Controller
{
	
	public function __construct()
	{
				
	}

	public function index()
	{
		
		$dt = [
		'title'=>'welcome'		
		];
		$this->view("pages/index", $dt);
	}

	public function about()
	{
		$dt = ['title'=>'welcome'];
		$this->view("pages/about", $dt);
	}
}

?>