<?php
//load config
require_once("config/config.php");

//load lib
/*require_once("libraries/Controller.php");
require_once("libraries/Core.php");
require_once("libraries/Database.php");*/


//autoload lib

spl_autoload_register(function ($class)
{
	require_once("libraries/".$class.".php");
});




?>