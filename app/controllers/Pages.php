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
		if (isLoggedIn()) {
			redirect("posts");
		}
		
		$dt = [
		'title'=>'Share Posts',
		'description' => 'PHP MVC Framework'		
		];
		$this->view("pages/index", $dt);
	}

	public function about()
	{
		$dt = [
		'title'=>'About Us',
		'description' => 'App to share posts with others'
		];
		$this->view("pages/about", $dt);
	}
}

?>