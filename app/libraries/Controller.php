<?php 
/*
Base Controller
Loads the models and views
*/

/**
* 
*/
class Controller
{
	
	function __construct()
	{
		# code...
	}
	//load model
	public function model($model)
	{
		require_once("../app/models/".$model.".php");

		return new $model();
	}

	//load view

	public function view($view, $data = [])
	{
		if (file_exists("../app/views/".$view.".php")) {
			require_once("../app/views/".$view.".php");
		}
		else
		{
			die("View doesn't exist");
		}
	}


}



 ?>