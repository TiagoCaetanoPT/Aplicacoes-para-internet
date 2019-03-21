<?php
namespace Ainet\Controllers;//onde eu tou
use Ainet\Models\User;//include da class user onde usei a funçao all


class UserController{


	public function index(){
		$users = User::all();
		$title="List of all Users";


		render_view('users.list', compact('users', 'title'));
	}

	public function add(){


		$title ='Add user';
		$errors=[];
		$user = new User;
		$password_confirmation='';

		// The first time (GET), just show the page
		if (empty($_POST)) {
			return render_view('users.add', compact('title', 'user', 'errors'));
		}

		$this->loadUserFromPost($user);
		$password_confirmation=$_POST["password_confirmation"] ?? "";

		$errors = $this->validateUser($user,$password_confirmation);
		if (count($errors) > 0) {
			return render_view('users.add', compact('title', 'user', 'errors'));
		}
		User::add($user);
		return $this->home();
	}

	public function loadUserFromPost($user){
		$user->fullname=$_POST["fullname"] ?? "";
		$user->email=$_POST["email"] ?? "";
		$user->type=$_POST["user_type"] ?? "";
		$user->password=$_POST["password"] ?? "";
	}


	public function validateUser($user,$password_confirmation){
		$errors=[];
		if ($user->fullname == "") {
			$errors['fullname']='Fullname is required';
		}
		if($user->type == ""){
			$errors['type']='Type is required';
		}
		if($user->email == ""){
			$errors['email']='Email is required';
		}
		if($user->password == ""){
			$errors['password']='Password is required';
		}
		if($password_confirmation == ""){
			$errors['password_confirmation']='Password confirmation is required';
		}
		if(strcmp($user->password,$password_confirmation)!=0){
			$errors['password_equals']='Password confirmation is required';
		}

		return $errors;
	}


}

?>
