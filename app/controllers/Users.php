<?php 
/**
* 
*/
class Users extends Controller
{
	
	function __construct()
	{
		$this->userModel = $this->model('User');
	}

	public function register()
	{
		//check for post
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
			//Sanitize POST Data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			//init data
			$dt = [
			'name' => trim($_POST["name"]),
			'email' => trim($_POST["email"]),
			'password' => trim($_POST["password"]),
			'confirm_password' => trim($_POST["confirm_password"]),
			'name_err' => '',
			'email_err' => '',
			'password_err' => '',
			'con_pass_err' => ''
			];

			//Validate Email
			if (empty($dt['email'])) {
				$dt['email_err'] = 'Please Enter E-mail';
			}else
			{
				if ($this->userModel->findUserByEmail($dt['email'])) {
					$dt['email_err'] = 'Email is already taken';
				}
			}
			//Validate Name
			if (empty($dt['name'])) {
				$dt['name_err'] = 'Please Enter Name';
			}
			//Validate Password
			if (empty($dt['password'])) {
				$dt['password_err'] = 'Please Enter Password';
			}elseif (strlen($dt['password'])<6) {
				$dt['password_err'] = 'Password must be at least 6 characters';
			}
			//Validate Confirm Password
			if (empty($dt['confirm_password'])) {
				$dt['con_pass_err'] = 'Please Retype Password';
			}elseif ($dt['password'] != $dt['confirm_password']) {
				$dt['con_pass_err'] = 'Retype password not match';
			}
			//make sure errors  are empty
			if (empty($dt['email_err']) && empty($dt['name_err']) && empty($dt['password_err']) && empty($dt['con_pass_err'])) {
				//validated
				//hash password
				$dt['password'] = password_hash($dt['password'], PASSWORD_DEFAULT);
				//Register User
				if ($this->userModel->register($dt)) {
					flash('register_success', 'You are registered success!Login');
					redirect("users/login");
				}
				else
				{
					die('Something went wrong!');
				}			

			}
			else
			{
				//load view/ errors
				$this->view("users/register", $dt);

			}
		}
		else
		{
			//init data
			$dt = [
			'name' => '',
			'email' => '',
			'password' => '',
			'confirm_password' => '',
			'name_err' => '',
			'email_err' => '',
			'password_err' => '',
			'con_pass_err' => ''
			];

			//load view
			$this->view("users/register", $dt);
			
			//load form
			//echo "load form";
		}
	}

	public function login()
	{
		//check for post
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
			//Sanitize POST Data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			//init data
			$dt = [			
			'email' => trim($_POST["email"]),
			'password' => trim($_POST["password"]),			
			'email_err' => '',
			'password_err' => ''			
			];

			//Validate Email
			if (empty($dt['email'])) {
				$dt['email_err'] = 'Please Enter E-mail';
			}
			//Validate Password
			if (empty($dt['password'])) {
				$dt['password_err'] = 'Please Enter Password';
			}elseif (strlen($dt['password'])<6) {
				$dt['password_err'] = 'Password must be at least 6 characters';
			}
			//check email
			if ($this->userModel->findUserByEmail($dt['email'])) {
				//user found

			}
			else
			{
				$dt['email_err'] = 'No User Found!';
			}

			//make sure errors  are empty
			if (empty($dt['email_err'])  && empty($dt['password_err'])) {
				//validated
				//check and set user
				$loggedInUser = $this->userModel->login($dt['email'], $dt['password']);
				if ($loggedInUser) {
					//create session
					$this->createUserSession($loggedInUser);
				}
				else
				{
					$dt['password_err'] = 'Password incorrect!';
					$this->view('users/login', $dt);
				}
			}
			else
			{
				//load view/ errors
				$this->view("users/login", $dt);

			}
		}
		else
		{
			//init data
			$dt = [			
			'email' => '',
			'password' => '',		
			'email_err' => '',
			'password_err' => ''			

			];

			$this->view("users/login", $dt);

			
		}
	}

	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->name;
		redirect('posts');
	}

	public function logout()
	{
		//unset($_SESSION['user_id']);
		session_destroy();
		redirect('users/login');
	}

	
}

 ?>